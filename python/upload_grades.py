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

# Load Excel file
excel_file = "d:/xampp/htdocs/ICS_Web_Portal/python/upload_grades.xlsx"  # Adjust path
try\]:
    df = pd.read_excel(excel_file)
except FileNotFoundError as e:
    print(f"Error: {e}")
    exit()

# Ensure numeric fields are properly converted and non-numeric handled
numeric_columns = ["student_id", "subject_id", "section_id", "teacher_id", 
                   "first_quarter", "second_quarter", "third_quarter", "fourth_quarter"]
for col in numeric_columns:
    df[col] = pd.to_numeric(df[col], errors="coerce")

# Ensure valid `academic_year` as string
df["academic_year"] = df["academic_year"].apply(lambda x: str(x).strip() if pd.notnull(x) else None)

# Filter rows with valid required fields
df = df.dropna(subset=["student_id", "subject_id", "section_id", "teacher_id", "academic_year"])

# Database connection and insertion
connection = None
try:
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    insert_query = """
    INSERT INTO grade (
        student_id, subject_id, section_id, teacher_id, academic_year, 
        first_quarter, second_quarter, third_quarter, fourth_quarter
    ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)
    """

    # Prepare data for insertion
    data_to_insert = list(df[[
        "student_id", "subject_id", "section_id", "teacher_id", 
        "academic_year", "first_quarter", "second_quarter", 
        "third_quarter", "fourth_quarter"
    ]].itertuples(index=False, name=None))

    # Use `executemany` for bulk insertion
    cursor.executemany(insert_query, data_to_insert)
    
    connection.commit()
    print(f"{cursor.rowcount} records inserted successfully.")

except mysql.connector.Error as err:
    print(f"Error: {err}")
finally:
    if connection and connection.is_connected():
        cursor.close()
        connection.close()
