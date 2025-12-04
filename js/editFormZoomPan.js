let editIsDragging = false;
let editStartX, editStartY;
let editCurrentX = 0,
  editCurrentY = 0;
let editScale = 1;
let editHasImage = false;
let editImageNaturalWidth = 0;
let editImageNaturalHeight = 0;
let editOriginalImageSrc = "";
let editCroppedBlob = null;

const EDIT_CONTAINER_SIZE = 150;
const EDIT_OUTPUT_SIZE = 800; // High quality 800x800 square output

const editFileInput = document.getElementById("maEditProfile");
const editCroppedFileInput = document.getElementById("editCroppedImageFile");
const editPlaceholder = document.getElementById("editProfilePlaceholder");
const editPreviewContainer = document.getElementById(
  "editProfilePreviewContainer"
);
const editPreviewImg = document.getElementById("maEditProfilePreview");
const editActionBtn = document.getElementById("editProfileActionBtn");
const editActionIcon = document.getElementById("editActionIcon");
const editImageControls = document.getElementById("editImageControls");
const editZoomSlider = document.getElementById("editZoomSlider");
const editZoomInBtn = document.getElementById("editZoomIn");
const editZoomOutBtn = document.getElementById("editZoomOut");
const editResetBtn = document.getElementById("editResetPosition");
const editCropCanvas = document.getElementById("editCropCanvas");
const editForm = document.getElementById("editAccount");

// Initialize: Check if there's an existing image (e.g., from server-side data)
if (editPreviewImg.src && editPreviewImg.src !== window.location.href) {
  // Existing image is present
  editOriginalImageSrc = editPreviewImg.src;
  const img = new Image();
  img.onload = function () {
    editImageNaturalWidth = img.width;
    editImageNaturalHeight = img.height;

    // Calculate initial scale to fit the circle
    const minDimension = Math.min(
      editImageNaturalWidth,
      editImageNaturalHeight
    );
    editScale = EDIT_CONTAINER_SIZE / minDimension;
    editZoomSlider.value = 100;

    // Set image dimensions based on natural ratio
    const displayWidth = editImageNaturalWidth * editScale;
    const displayHeight = editImageNaturalHeight * editScale;
    editPreviewImg.style.width = displayWidth + "px";
    editPreviewImg.style.height = displayHeight + "px";

    // Center the image initially
    editCurrentX = (EDIT_CONTAINER_SIZE - displayWidth) / 2;
    editCurrentY = (EDIT_CONTAINER_SIZE - displayHeight) / 2;

    updateEditImageTransform();

    // Hide placeholder, show image
    editPlaceholder.style.display = "none";
    editPreviewImg.style.display = "block";

    // Switch to remove button
    editActionBtn.classList.remove("btn-primary");
    editActionBtn.classList.add("btn-danger");
    editActionIcon.classList.remove("bi-camera-fill");
    editActionIcon.classList.add("bi-x-lg");

    // Show controls
    editImageControls.style.display = "block";

    editHasImage = true;
  };
  img.src = editPreviewImg.src;
} else {
  // No image, show placeholder
  editPlaceholder.style.display = "flex";
  editPreviewImg.style.display = "none";
}

// Click placeholder to upload
editPlaceholder.addEventListener("click", function () {
  editFileInput.click();
});

// Action button click handler
editActionBtn.addEventListener("click", function (e) {
  e.stopPropagation();
  if (editHasImage) {
    removeEditImage();
  } else {
    editFileInput.click();
  }
});

// Constrain position within bounds
function constrainEditPosition(x, y) {
  const displayWidth = editImageNaturalWidth * editScale;
  const displayHeight = editImageNaturalHeight * editScale;

  // Calculate boundaries
  const minX = EDIT_CONTAINER_SIZE - displayWidth;
  const maxX = 0;
  const minY = EDIT_CONTAINER_SIZE - displayHeight;
  const maxY = 0;

  // Constrain x and y
  const constrainedX = Math.min(Math.max(x, minX), maxX);
  const constrainedY = Math.min(Math.max(y, minY), maxY);

  return { x: constrainedX, y: constrainedY };
}

// Crop image to 1:1 square based on current position and scale
function cropEditImageToSquare() {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = function () {
      try {
        // Set canvas to square output size (1:1 aspect ratio)
        editCropCanvas.width = EDIT_OUTPUT_SIZE;
        editCropCanvas.height = EDIT_OUTPUT_SIZE;
        const ctx = editCropCanvas.getContext("2d");

        // Clear canvas
        ctx.clearRect(0, 0, EDIT_OUTPUT_SIZE, EDIT_OUTPUT_SIZE);

        // Calculate the crop area in the original image coordinates
        const displayWidth = editImageNaturalWidth * editScale;
        const displayHeight = editImageNaturalHeight * editScale;

        // Calculate the ratio between display size and actual image size
        const ratio = editImageNaturalWidth / displayWidth;

        // Calculate source coordinates (what part of the original image to crop)
        const sourceX = Math.abs(editCurrentX * ratio);
        const sourceY = Math.abs(editCurrentY * ratio);
        const sourceSize = EDIT_CONTAINER_SIZE * ratio;

        // Draw the cropped portion as a square
        ctx.drawImage(
          img,
          sourceX,
          sourceY,
          sourceSize,
          sourceSize, // Source: square portion
          0,
          0,
          EDIT_OUTPUT_SIZE,
          EDIT_OUTPUT_SIZE // Destination: square canvas
        );

        // Convert canvas to blob
        editCropCanvas.toBlob(
          (blob) => {
            if (blob) {
              resolve(blob);
            } else {
              reject(new Error("Failed to create blob"));
            }
          },
          "image/jpeg",
          0.95
        );
      } catch (error) {
        reject(error);
      }
    };
    img.onerror = function () {
      reject(new Error("Failed to load image"));
    };
    img.src = editOriginalImageSrc;
  });
}

// Form submit handler
editForm.addEventListener("submit", async function (e) {
  if (editHasImage) {
    e.preventDefault();

    // Show loading state
    const submitBtn = editForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML =
      '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

    try {
      // Crop the image to 1:1 square
      editCroppedBlob = await cropEditImageToSquare();

      // Create a File object from the blob
      const croppedFile = new File([editCroppedBlob], "profile_cropped.jpg", {
        type: "image/jpeg",
      });

      // Create a DataTransfer to set the file input
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(croppedFile);
      editCroppedFileInput.files = dataTransfer.files;

      // Small delay to ensure file is set
      setTimeout(() => {
        // Submit the form
        editForm.submit();
      }, 100);
    } catch (error) {
      console.error("Error cropping image:", error);
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
      alert("Error processing image. Please try again.");
    }
  }
});

// File input change handler
editFileInput.addEventListener("change", function (event) {
  const file = event.target.files[0];

  if (file && file.type.startsWith("image/")) {
    const reader = new FileReader();
    reader.onload = function (e) {
      editOriginalImageSrc = e.target.result;
      const img = new Image();
      img.onload = function () {
        editImageNaturalWidth = img.width;
        editImageNaturalHeight = img.height;

        // Calculate initial scale to fit the circle
        const minDimension = Math.min(
          editImageNaturalWidth,
          editImageNaturalHeight
        );
        const initialScale = EDIT_CONTAINER_SIZE / minDimension;

        editScale = initialScale;
        editZoomSlider.value = 100;

        editPreviewImg.src = e.target.result;

        // Set image dimensions based on natural ratio
        const displayWidth = editImageNaturalWidth * editScale;
        const displayHeight = editImageNaturalHeight * editScale;
        editPreviewImg.style.width = displayWidth + "px";
        editPreviewImg.style.height = displayHeight + "px";

        // Center the image initially
        editCurrentX = (EDIT_CONTAINER_SIZE - displayWidth) / 2;
        editCurrentY = (EDIT_CONTAINER_SIZE - displayHeight) / 2;

        updateEditImageTransform();

        // Hide placeholder, show image
        editPlaceholder.style.display = "none";
        editPreviewImg.style.display = "block";

        // Switch to remove button
        editActionBtn.classList.remove("btn-primary");
        editActionBtn.classList.add("btn-danger");
        editActionIcon.classList.remove("bi-camera-fill");
        editActionIcon.classList.add("bi-x-lg");

        // Show controls
        editImageControls.style.display = "block";

        editHasImage = true;
      };
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
});

// Remove image function
function removeEditImage() {
  editFileInput.value = "";
  editCroppedFileInput.value = "";
  editPreviewImg.src = "";
  editOriginalImageSrc = "";
  editCroppedBlob = null;

  // Show placeholder, hide image
  editPlaceholder.style.display = "flex";
  editPreviewImg.style.display = "none";

  // Switch back to camera button
  editActionBtn.classList.remove("btn-danger");
  editActionBtn.classList.add("btn-primary");
  editActionIcon.classList.remove("bi-x-lg");
  editActionIcon.classList.add("bi-camera-fill");

  // Hide controls
  editImageControls.style.display = "none";

  editHasImage = false;
  editCurrentX = 0;
  editCurrentY = 0;
  editScale = 1;
}

// Update image transform
function updateEditImageTransform() {
  const displayWidth = editImageNaturalWidth * editScale;
  const displayHeight = editImageNaturalHeight * editScale;

  editPreviewImg.style.width = displayWidth + "px";
  editPreviewImg.style.height = displayHeight + "px";
  editPreviewImg.style.left = editCurrentX + "px";
  editPreviewImg.style.top = editCurrentY + "px";
}

// Zoom slider
editZoomSlider.addEventListener("input", function () {
  if (!editHasImage) return;

  const zoomPercent = parseInt(this.value);
  const minDimension = Math.min(editImageNaturalWidth, editImageNaturalHeight);
  const baseScale = EDIT_CONTAINER_SIZE / minDimension;

  // Store old dimensions and center point
  const oldDisplayWidth = editImageNaturalWidth * editScale;
  const oldDisplayHeight = editImageNaturalHeight * editScale;
  const oldCenterX = editCurrentX + oldDisplayWidth / 2;
  const oldCenterY = editCurrentY + oldDisplayHeight / 2;

  // Update scale
  editScale = baseScale * (zoomPercent / 100);

  // Calculate new dimensions
  const newDisplayWidth = editImageNaturalWidth * editScale;
  const newDisplayHeight = editImageNaturalHeight * editScale;

  // Adjust position to keep the same center point
  editCurrentX = oldCenterX - newDisplayWidth / 2;
  editCurrentY = oldCenterY - newDisplayHeight / 2;

  // Constrain the position
  const constrained = constrainEditPosition(editCurrentX, editCurrentY);
  editCurrentX = constrained.x;
  editCurrentY = constrained.y;

  updateEditImageTransform();
});

// Zoom buttons
editZoomInBtn.addEventListener("click", function () {
  const currentValue = parseInt(editZoomSlider.value);
  editZoomSlider.value = Math.min(300, currentValue + 10);
  editZoomSlider.dispatchEvent(new Event("input"));
});

editZoomOutBtn.addEventListener("click", function () {
  const currentValue = parseInt(editZoomSlider.value);
  editZoomSlider.value = Math.max(100, currentValue - 10);
  editZoomSlider.dispatchEvent(new Event("input"));
});

// Reset button
editResetBtn.addEventListener("click", function () {
  if (!editHasImage) return;

  const minDimension = Math.min(editImageNaturalWidth, editImageNaturalHeight);
  editScale = EDIT_CONTAINER_SIZE / minDimension;

  const displayWidth = editImageNaturalWidth * editScale;
  const displayHeight = editImageNaturalHeight * editScale;
  editCurrentX = (EDIT_CONTAINER_SIZE - displayWidth) / 2;
  editCurrentY = (EDIT_CONTAINER_SIZE - displayHeight) / 2;

  editZoomSlider.value = 100;
  updateEditImageTransform();
});

// Mouse wheel zoom
editPreviewContainer.addEventListener("wheel", function (e) {
  if (!editHasImage) return;
  e.preventDefault();

  const delta = e.deltaY > 0 ? -10 : 10;
  const currentValue = parseInt(editZoomSlider.value);
  editZoomSlider.value = Math.max(100, Math.min(300, currentValue + delta));
  editZoomSlider.dispatchEvent(new Event("input"));
});

// Drag functionality
editPreviewContainer.addEventListener("mousedown", function (e) {
  if (!editHasImage) return;
  editIsDragging = true;
  editStartX = e.clientX - editCurrentX;
  editStartY = e.clientY - editCurrentY;
  editPreviewContainer.style.cursor = "grabbing";
  e.preventDefault();
});

document.addEventListener("mousemove", function (e) {
  if (!editIsDragging) return;

  let newX = e.clientX - editStartX;
  let newY = e.clientY - editStartY;

  // Constrain position
  const constrained = constrainEditPosition(newX, newY);
  editCurrentX = constrained.x;
  editCurrentY = constrained.y;

  updateEditImageTransform();
});

document.addEventListener("mouseup", function () {
  if (editIsDragging) {
    editIsDragging = false;
    editPreviewContainer.style.cursor = "move";
  }
});

// Touch events for mobile
editPreviewContainer.addEventListener("touchstart", function (e) {
  if (!editHasImage) return;
  editIsDragging = true;
  const touch = e.touches[0];
  editStartX = touch.clientX - editCurrentX;
  editStartY = touch.clientY - editCurrentY;
  e.preventDefault();
});

document.addEventListener("touchmove", function (e) {
  if (!editIsDragging) return;

  const touch = e.touches[0];
  let newX = touch.clientX - editStartX;
  let newY = touch.clientY - editStartY;

  // Constrain position
  const constrained = constrainEditPosition(newX, newY);
  editCurrentX = constrained.x;
  editCurrentY = constrained.y;

  updateEditImageTransform();
});

document.addEventListener("touchend", function () {
  if (editIsDragging) {
    editIsDragging = false;
  }
});
