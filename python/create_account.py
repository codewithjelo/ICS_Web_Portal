import mysql.connector
import bcrypt  # For password hashing

# Database connection setup
db_config = {
    "host": "localhost",
    "port": 3308,
    "user": "root",
    "password": "",  # Update if you have a password
    "database": "ics_db"
}

def fetch_guidance_ids():
    """Fetch all guidance_id values from the guidance table."""
    connection = None
    try:
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor()
        query = "SELECT guidance_id FROM guidance"
        cursor.execute(query)
        guidance_ids = [row[0] for row in cursor.fetchall()]  # Extract guidance_ids into a list
        return guidance_ids
    except mysql.connector.Error as err:
        print(f"Error: {err}")
        return []
    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

def insert_accounts(guidance_ids):
    """Insert guidance accounts into the account table with hashed passwords and role."""
    connection = None
    try:
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor()

        insert_query = """
        INSERT INTO account (user_id, user_password, role_id)
        VALUES (%s, %s, %s)
        """

        hashed_password = bcrypt.hashpw("guidance_123".encode('utf-8'), bcrypt.gensalt()).decode('utf-8')

        # Prepare data for insertion
        data_to_insert = [(f"ICS-GUI{guidance_id}", hashed_password, 2) for guidance_id in guidance_ids]

        # Insert data
        cursor.executemany(insert_query, data_to_insert)
        connection.commit()
        print(f"{cursor.rowcount} guidance accounts created successfully.")

    except mysql.connector.Error as err:
        print(f"Error: {err}")
    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

# Main logic
if __name__ == "__main__":
    guidance_ids = fetch_guidance_ids()
    if guidance_ids:
        insert_accounts(guidance_ids)
    else:
        print("No guidance IDs found or error fetching guidance IDs.")
