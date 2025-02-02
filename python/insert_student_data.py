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

# Function to process dates
def process_date(value):
    try:
        date = pd.to_datetime(value, errors='coerce')  # Parse dates
        return date.date() if pd.notnull(date) else None  # Return date or None
    except Exception:
        return None

# Load Excel file
excel_file = "d:/xampp/htdocs/ICS_Web_Portal/python/parentrecord.xlsx"  # Adjust path
try:
    df = pd.read_excel(excel_file)
except FileNotFoundError as e:
    print(f"Error: {e}")
    exit()

# Process fields
df["first_name"] = df["first_name"].apply(title_case_or_null)
df["middle_name"] = df["middle_name"].apply(title_case_or_null)
df["last_name"] = df["last_name"].apply(title_case_or_null)

# Assign a fixed role_id
df["role_id"] = 1  # Example: set role_id to 1 for all rows

# Database connection and insertion
connection = None
try:
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    insert_query = """
    INSERT INTO parent (
        first_name, middle_name, last_name, email, address, role_id
    ) VALUES (%s, %s, %s, %s, %s, %s)
    """

    # Iterate through rows and insert into the database
    for _, row in df.iterrows():
        cursor.execute(insert_query, (
            row["first_name"], 
            row["middle_name"], 
            row["last_name"], 
            row.get("email"),    # Update if this column exists in the Excel
            row.get("address"),  # Update if this column exists in the Excel
            row["role_id"]       # Use the fixed role_id
        ))

    connection.commit()
    print(f"{cursor.rowcount} records inserted successfully.")

except mysql.connector.Error as err:
    print(f"Error: {err}")
finally:
    if connection and connection.is_connected():
        cursor.close()
        connection.close()
