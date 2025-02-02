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

# Function to convert text to Title Case or keep None for NULL values
def title_case_or_null(value):
    if pd.isnull(value) or str(value).strip().upper() == "NULL":
        return None
    return str(value).title()

# Load Excel file
excel_file = "d:/xampp/htdocs/ICS_Web_Portal/python/teacher_record.xlsx"  # Adjust path
try:
    df = pd.read_excel(excel_file)
except FileNotFoundError as e:
    print(f"Error: {e}")
    exit()

# Process fields
df["first_name"] = df["first_name"].apply(title_case_or_null)
df["middle_name"] = df["middle_name"].apply(title_case_or_null)
df["last_name"] = df["last_name"].apply(title_case_or_null)
df["email"] = df["email"].apply(lambda x: x.strip().lower() if pd.notnull(x) else None)  # Normalize email
df["role_id"] = df["role_id"].apply(pd.to_numeric, errors="coerce")  # Ensure role_id is numeric
df["rank_id"] = df["rank_id"].apply(pd.to_numeric, errors="coerce")  # Ensure rank_id is numeric

# Database connection and insertion
connection = None
try:
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    insert_query = """
    INSERT INTO teacher (
        first_name, middle_name, last_name, email, role_id, rank_id
    ) VALUES (%s, %s, %s, %s, %s, %s)
    """

    for _, row in df.iterrows():
        cursor.execute(insert_query, (
            row["first_name"], 
            row["middle_name"], 
            row["last_name"], 
            row["email"], 
            row["role_id"], 
            row["rank_id"]
        ))

    connection.commit()
    print(f"{cursor.rowcount} records inserted successfully.")

except mysql.connector.Error as err:
    print(f"Error: {err}")
finally:
    if connection and connection.is_connected():
        cursor.close()
        connection.close()
