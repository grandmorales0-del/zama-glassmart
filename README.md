# zama-glassmart
sch proj
GLASSMART SALES, STOCK, PURCHASES & ONLINE ORDERS SYSTEM
=======================================================

This package connects the existing GlassMart dashboard design to PHP and MySQL.

FEATURES
- Role-based sign-in: admin, manager, staff and customer account types.
- Shared MySQL records instead of browser localStorage.
- Dashboard totals, sales history and low-stock monitoring.
- Sales recording with automatic stock deduction.
- Inventory and stock adjustments.
- Supplier purchase records with automatic stock increase.
- Online order page at order.php.
- Remote order status management.
- SMS notification queue records for active admin/manager phone numbers.

IMPORTANT SMS NOTE
This package records notification requests in the sms_notifications table with
status "Queued". It does NOT send real SMS messages yet. To send real messages,
a legitimate SMS provider account and API integration are required. Do not tell
users that a text was delivered until the provider confirms delivery.

INSTALLATION (XAMPP / WINDOWS)
1. Copy the whole glassmart_integrated folder into:
   C:\xampp\htdocs\
2. Rename the folder to:
   glassmart
3. Start Apache and MySQL in the XAMPP Control Panel.
4. Open http://localhost/phpmyadmin
5. Import schema.sql using the Import tab.
6. Check db.php. The default XAMPP MySQL username is root and password is blank.
   If your MySQL password is different, update $user and $pass.
7. Create the first administrator:
   Open http://localhost/glassmart/create_user.php?key=ChangeThisSetupKey
   Create an admin account with a strong password of at least 10 characters.
   The setup key is a temporary protection only. Change it before use if needed.
8. DELETE create_user.php after creating your first administrator.
9. Sign in at http://localhost/glassmart/login.php
10. Create manager and staff accounts using the same account-creation page only
    while it is available. For normal use, implement a protected user-management
    screen or have an administrator create accounts. Do not leave the setup file
    on a live server.

PUBLIC ONLINE ORDERS
Customers do not need staff login to submit an order:
http://localhost/glassmart/order.php
Online orders are saved in MySQL and can be viewed by signed-in staff.

ROLE PERMISSIONS
- Admin: all dashboard operations; can add products and record purchases.
- Manager: sales, inventory, purchases, orders and notification history.
- Staff: sales, view inventory and process orders.
- Customer: customer account role is reserved; customers place orders through
  the public order page. Customer accounts cannot access the staff dashboard.

FILES
- index.php: authenticated GlassMart dashboard using the existing visual layout.
- login.php / logout.php: sign-in and sign-out.
- auth.php: session and role checks.
- db.php: MySQL connection.
- api.php: server-side operations and permission checks.
- order.php: public online order form.
- schema.sql: database and table structure.
- app.js: dashboard interactions through PHP endpoints (no localStorage).
- style.css: original design plus login/order page styling.

SECURITY / PROJECT NOTES
- This is a learning/project starter, not a fully hardened production deployment.
- Use HTTPS on a live website.
- Use strong passwords and keep database credentials private.
- Remove setup scripts after initial account creation.
- Back up the database.
- Add CSRF protection, rate limiting, audit logs and a proper administrator-only
  user-management screen before public production deployment.
- The system creates queued SMS records only; configure an SMS provider separately.
