import mysql.connector

# Database connection setup
db_config = {
    "host": "localhost",
    "port": 3308,
    "user": "root",
    "password": "",  # Update if you have a password
    "database": "ics_db"
}

connection = None

try:
    # Connect to the database
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    # Query to fetch all last names
    select_query = "SELECT last_name FROM student"

    # Execute the query
    cursor.execute(select_query)

    # Fetch all results
    last_names = cursor.fetchall()

    # Print the last names
    print("Last Names:")
    for last_name in last_names:
        print(last_name[0])  # Accessing the first column (last_name)

except mysql.connector.Error as err:
    print(f"Error: {err}")

finally:
    # Close the connection
    if connection and connection.is_connected():
        cursor.close()
        connection.close()
