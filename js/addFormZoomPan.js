let isDragging = false;
let startX, startY;
let currentX = 0,
  currentY = 0;
let scale = 1;
let hasImage = false;
let imageNaturalWidth = 0;
let imageNaturalHeight = 0;
let originalImageSrc = "";
let croppedBlob = null;

const CONTAINER_SIZE = 150;
const OUTPUT_SIZE = 800; // High quality 800x800 square output

const fileInput = document.getElementById("maProfilePic");
const croppedFileInput = document.getElementById("croppedImageFile");
const placeholder = document.getElementById("profilePlaceholder");
const previewContainer = document.getElementById("profilePreviewContainer");
const previewImg = document.getElementById("profilePreviewImg");
const actionBtn = document.getElementById("profileActionBtn");
const actionIcon = document.getElementById("actionIcon");
const imageControls = document.getElementById("imageControls");
const zoomSlider = document.getElementById("zoomSlider");
const zoomInBtn = document.getElementById("zoomIn");
const zoomOutBtn = document.getElementById("zoomOut");
const resetBtn = document.getElementById("resetPosition");
const cropCanvas = document.getElementById("cropCanvas");
const form = document.getElementById("addAccount");

// Click placeholder to upload
placeholder.addEventListener("click", function () {
  fileInput.click();
});

// Action button click handler
actionBtn.addEventListener("click", function (e) {
  e.stopPropagation();
  if (hasImage) {
    removeImage();
  } else {
    fileInput.click();
  }
});

// Constrain position within bounds
function constrainPosition(x, y) {
  const displayWidth = imageNaturalWidth * scale;
  const displayHeight = imageNaturalHeight * scale;

  // Calculate boundaries
  const minX = CONTAINER_SIZE - displayWidth;
  const maxX = 0;
  const minY = CONTAINER_SIZE - displayHeight;
  const maxY = 0;

  // Constrain x and y
  const constrainedX = Math.min(Math.max(x, minX), maxX);
  const constrainedY = Math.min(Math.max(y, minY), maxY);

  return { x: constrainedX, y: constrainedY };
}

// Crop image to 1:1 square based on current position and scale
function cropImageToSquare() {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = function () {
      try {
        // Set canvas to square output size (1:1 aspect ratio)
        cropCanvas.width = OUTPUT_SIZE;
        cropCanvas.height = OUTPUT_SIZE;
        const ctx = cropCanvas.getContext("2d");

        // Clear canvas
        ctx.clearRect(0, 0, OUTPUT_SIZE, OUTPUT_SIZE);

        // Calculate the crop area in the original image coordinates
        const displayWidth = imageNaturalWidth * scale;
        const displayHeight = imageNaturalHeight * scale;

        // Calculate the ratio between display size and actual image size
        const ratio = imageNaturalWidth / displayWidth;

        // Calculate source coordinates (what part of the original image to crop)
        const sourceX = Math.abs(currentX * ratio);
        const sourceY = Math.abs(currentY * ratio);
        const sourceSize = CONTAINER_SIZE * ratio;

        // Draw the cropped portion as a square
        ctx.drawImage(
          img,
          sourceX,
          sourceY,
          sourceSize,
          sourceSize, // Source: square portion
          0,
          0,
          OUTPUT_SIZE,
          OUTPUT_SIZE // Destination: square canvas
        );

        // Convert canvas to blob
        cropCanvas.toBlob(
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
    img.src = originalImageSrc;
  });
}

// Form submit handler
form.addEventListener("submit", async function (e) {
  if (hasImage) {
    e.preventDefault();

    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML =
      '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

    try {
      // Crop the image to 1:1 square
      croppedBlob = await cropImageToSquare();

      // Create a File object from the blob
      const croppedFile = new File([croppedBlob], "profile_cropped.jpg", {
        type: "image/jpeg",
      });

      // Create a DataTransfer to set the file input
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(croppedFile);
      croppedFileInput.files = dataTransfer.files;

      // Small delay to ensure file is set
      setTimeout(() => {
        // Submit the form
        form.submit();
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
fileInput.addEventListener("change", function (event) {
  const file = event.target.files[0];

  if (file && file.type.startsWith("image/")) {
    const reader = new FileReader();
    reader.onload = function (e) {
      originalImageSrc = e.target.result;
      const img = new Image();
      img.onload = function () {
        imageNaturalWidth = img.width;
        imageNaturalHeight = img.height;

        // Calculate initial scale to fit the circle
        const minDimension = Math.min(imageNaturalWidth, imageNaturalHeight);
        const initialScale = CONTAINER_SIZE / minDimension;

        scale = initialScale;
        zoomSlider.value = 100;

        previewImg.src = e.target.result;

        // Set image dimensions based on natural ratio
        const displayWidth = imageNaturalWidth * scale;
        const displayHeight = imageNaturalHeight * scale;
        previewImg.style.width = displayWidth + "px";
        previewImg.style.height = displayHeight + "px";

        // Center the image initially
        currentX = (CONTAINER_SIZE - displayWidth) / 2;
        currentY = (CONTAINER_SIZE - displayHeight) / 2;

        updateImageTransform();

        // Show preview container, hide placeholder
        placeholder.style.display = "none";
        previewContainer.style.display = "block";

        // Switch to remove button
        actionBtn.classList.remove("btn-primary");
        actionBtn.classList.add("btn-danger");
        actionIcon.classList.remove("bi-camera-fill");
        actionIcon.classList.add("bi-x-lg");

        // Show controls
        imageControls.style.display = "block";

        hasImage = true;
      };
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
});

// Remove image function
function removeImage() {
  fileInput.value = "";
  croppedFileInput.value = "";
  previewImg.src = "";
  originalImageSrc = "";
  croppedBlob = null;
  previewContainer.style.display = "none";
  placeholder.style.display = "flex";

  // Switch back to camera button
  actionBtn.classList.remove("btn-danger");
  actionBtn.classList.add("btn-primary");
  actionIcon.classList.remove("bi-x-lg");
  actionIcon.classList.add("bi-camera-fill");

  // Hide controls
  imageControls.style.display = "none";

  hasImage = false;
  currentX = 0;
  currentY = 0;
  scale = 1;
}

// Update image transform
function updateImageTransform() {
  const displayWidth = imageNaturalWidth * scale;
  const displayHeight = imageNaturalHeight * scale;

  previewImg.style.width = displayWidth + "px";
  previewImg.style.height = displayHeight + "px";
  previewImg.style.left = currentX + "px";
  previewImg.style.top = currentY + "px";
}

// Zoom slider
zoomSlider.addEventListener("input", function () {
  if (!hasImage) return;

  const zoomPercent = parseInt(this.value);
  const minDimension = Math.min(imageNaturalWidth, imageNaturalHeight);
  const baseScale = CONTAINER_SIZE / minDimension;

  // Store old dimensions and center point
  const oldDisplayWidth = imageNaturalWidth * scale;
  const oldDisplayHeight = imageNaturalHeight * scale;
  const oldCenterX = currentX + oldDisplayWidth / 2;
  const oldCenterY = currentY + oldDisplayHeight / 2;

  // Update scale
  scale = baseScale * (zoomPercent / 100);

  // Calculate new dimensions
  const newDisplayWidth = imageNaturalWidth * scale;
  const newDisplayHeight = imageNaturalHeight * scale;

  // Adjust position to keep the same center point
  currentX = oldCenterX - newDisplayWidth / 2;
  currentY = oldCenterY - newDisplayHeight / 2;

  // Constrain the position
  const constrained = constrainPosition(currentX, currentY);
  currentX = constrained.x;
  currentY = constrained.y;

  updateImageTransform();
});

// Zoom buttons
zoomInBtn.addEventListener("click", function () {
  const currentValue = parseInt(zoomSlider.value);
  zoomSlider.value = Math.min(300, currentValue + 10);
  zoomSlider.dispatchEvent(new Event("input"));
});

zoomOutBtn.addEventListener("click", function () {
  const currentValue = parseInt(zoomSlider.value);
  zoomSlider.value = Math.max(100, currentValue - 10);
  zoomSlider.dispatchEvent(new Event("input"));
});

// Reset button
resetBtn.addEventListener("click", function () {
  if (!hasImage) return;

  const minDimension = Math.min(imageNaturalWidth, imageNaturalHeight);
  scale = CONTAINER_SIZE / minDimension;

  const displayWidth = imageNaturalWidth * scale;
  const displayHeight = imageNaturalHeight * scale;
  currentX = (CONTAINER_SIZE - displayWidth) / 2;
  currentY = (CONTAINER_SIZE - displayHeight) / 2;

  zoomSlider.value = 100;
  updateImageTransform();
});

// Mouse wheel zoom
previewContainer.addEventListener("wheel", function (e) {
  if (!hasImage) return;
  e.preventDefault();

  const delta = e.deltaY > 0 ? -10 : 10;
  const currentValue = parseInt(zoomSlider.value);
  zoomSlider.value = Math.max(100, Math.min(300, currentValue + delta));
  zoomSlider.dispatchEvent(new Event("input"));
});

// Drag functionality
previewContainer.addEventListener("mousedown", function (e) {
  if (!hasImage) return;
  isDragging = true;
  startX = e.clientX - currentX;
  startY = e.clientY - currentY;
  previewContainer.style.cursor = "grabbing";
  e.preventDefault();
});

document.addEventListener("mousemove", function (e) {
  if (!isDragging) return;

  let newX = e.clientX - startX;
  let newY = e.clientY - startY;

  // Constrain position
  const constrained = constrainPosition(newX, newY);
  currentX = constrained.x;
  currentY = constrained.y;

  updateImageTransform();
});

document.addEventListener("mouseup", function () {
  if (isDragging) {
    isDragging = false;
    previewContainer.style.cursor = "move";
  }
});

// Touch events for mobile
previewContainer.addEventListener("touchstart", function (e) {
  if (!hasImage) return;
  isDragging = true;
  const touch = e.touches[0];
  startX = touch.clientX - currentX;
  startY = touch.clientY - currentY;
  e.preventDefault();
});

document.addEventListener("touchmove", function (e) {
  if (!isDragging) return;

  const touch = e.touches[0];
  let newX = touch.clientX - startX;
  let newY = touch.clientY - startY;

  // Constrain position
  const constrained = constrainPosition(newX, newY);
  currentX = constrained.x;
  currentY = constrained.y;

  updateImageTransform();
});

document.addEventListener("touchend", function () {
  if (isDragging) {
    isDragging = false;
  }
});
