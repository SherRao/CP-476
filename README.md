# CP-476


## Setting up the SQL environment
- Ensure you have a MySQL server running on `localhost` on port `3306`. Ensure that the root username is `root` and password is `password`.

- Login to the MySQL server using the root user and password. Create a database called `cp476` using the following command:
```mysql
CREATE DATABASE cp476;
```

- Staying logged into the MySQL environment, copy all the contents from the `courses.sql` file and paste it into the MySQL shell. This will create the `NameTable` and `CourseTable` table.

- Afterwards, ensure you have [Mysql-connector](https://pypi.org/project/mysql-connector-python/) installed via PIP3. If not, install it using the following command:
```bash
pip3 install mysql-connector-python
```

- After this, `cd` into the `db` folder using the following command:
```bash
cd src/db/
```

- Run the `init_tables` script using the following command:
```bash
python3 init_tables.py root password
```

- Done! You have successfully set up the SQL environment.
