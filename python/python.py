import pandas as pd
import mysql.connector

# Database connection setup
db_config = {
    "host": "localhost",
    "port": 3308,
    "user": "root",
    "password": "",  # Update if you have a password
    "database": "ics_db"
}

# Function to convert to numeric or keep None for invalid values
def numeric_or_null(value):
    try:
        return pd.to_numeric(value, errors="coerce")
    except ValueError:
        return None

# Load Excel file
excel_file = "d:/xampp/htdocs/ICS_Web_Portal/python/teacher_subject.xlsx"  # Adjust path
try:
    df = pd.read_excel(excel_file)
except FileNotFoundError as e:
    print(f"Error: {e}")
    exit()

# Ensure numeric values for `teacher_id` and `section_id`
df["teacher_id"] = df["teacher_id"].apply(numeric_or_null)
df["subject_id"] = df["subject_id"].apply(numeric_or_null)

# Filter rows with valid `teacher_id` and `section_id`
df = df.dropna(subset=["teacher_id", "subject_id"])

# Database connection and insertion
connection = None
try:
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    insert_query = """
    INSERT INTO teacher_subject (
        teacher_id, subject_id
    ) VALUES (%s, %s)
    """

    # Prepare data for insertion
    data_to_insert = list(df[["teacher_id", "subject_id"]].itertuples(index=False, name=None))
    
    # Use `executemany` for efficient bulk insertion
    cursor.executemany(insert_query, data_to_insert)
    
    connection.commit()
    print(f"{cursor.rowcount} records inserted successfully.")

except mysql.connector.Error as err:
    print(f"Error: {err}")
finally:
    if connection and connection.is_connected():
        cursor.close()
        connection.close()
