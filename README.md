# 📚 Event Planner — PHP MySQL CRUD Project

A simple and interactive **Event Planner Web Application** built with **PHP**, **MySQL**, and **CSS**.  
It supports full **CRUD** operations (**Create, Read, Update, Delete**) and has a stylish, colorful interface with search functionality.

---

## 📂 Project Structure

| File Name         | Description                                      |
|-------------------|--------------------------------------------------|
| `index.php`       | Main page showing list of events with Edit/Delete options |
| `add_event.php`   | Form page to create a new event                   |
| `edit_event.php`  | Form page to edit an existing event               |
| `delete_event.php`| Script to delete an event                         |
| `view_events.php` | Card-style page to search and view events         |
| `db_connect.php`  | Database connection script                       |
| `styles.css`      | CSS file to design and beautify the web pages     |

---

## 💻 Features

- ➕ Add a new event (title, date, location, description)
- 🖍️ Edit existing events
- 🗑️ Delete events with confirmation
- 🔍 Search events by title, location, or description
- 🌈 Beautiful and responsive design with animations
- 🚀 Fast and simple user interface

---

## 🛠️ Technology Used

- **Frontend**: HTML5, CSS3 (Flexbox, Animations, Gradients)
- **Backend**: PHP 7+
- **Database**: MySQL

---

## ⚙️ How to Setup and Run

1. Install **XAMPP** or **WAMP** server.
2. Copy project files into the `htdocs` (or `www`) directory.
3. Start **Apache** and **MySQL** using XAMPP control panel.
4. Open **phpMyAdmin** and create a new database called:

```sql
CREATE DATABASE event_planner;
```

5. Inside the `event_planner` database, create a table:

```sql
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    location VARCHAR(255) NOT NULL,
    description TEXT
);
```

6. Open your browser and visit:

```
http://localhost/your_project_folder/index.php
```

---

## 📷 Screenshots (Optional)

> You can later add project screenshots here like:
>
> - Home Page (Event List)
> - Add Event Page
> - Edit Event Page
> - View Events Search Page

---

## 😚 Acknowledgments

Made with ❤️ for educational learning and web development practice.

---

# 🚀 Thank You for Visiting!
