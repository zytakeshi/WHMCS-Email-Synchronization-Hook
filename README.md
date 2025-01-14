# WHMCS Email Synchronization Hook

This WHMCS hook ensures that when a client's email is updated in `tblclients`, the corresponding email in `tblusers` is automatically synchronized. It leverages the `tblusers_clients` table to establish the relationship between clients and users.

---

## Features

- Automatically synchronizes email changes in `tblclients` to `tblusers`.
- Utilizes the `ClientEdit` hook for seamless integration with WHMCS workflows.
- Maintains consistency across the WHMCS user and client management system.

---

## Requirements

- WHMCS version 8.0 or higher.
- PHP 7.4 or higher (recommended PHP 8.1 or higher).
- Access to the `includes/hooks` directory to deploy the script.

---

## Installation

1. **Download the Hook:**
   Download the `emailsync.php` file from this repository.

2. **Place the File:**
   Upload the file to your WHMCS installation directory:

/path/to/whmcs/includes/hooks/emailsync.php

3. **Verify Database Structure:**
Ensure the following tables and columns exist in your WHMCS database:
- `tblclients` with a `userid` column.
- `tblusers` with an `id` and `email` column.
- `tblusers_clients` with `client_id` and `auth_user_id` columns.

4. **Test the Hook:**
- Edit a client's email in the WHMCS admin or client area.
- Verify that the email is updated in the corresponding `tblusers` entry.

---

## How It Works

1. **Trigger:**
- The `ClientEdit` hook triggers whenever a client's profile is updated.

2. **Relationship Lookup:**
- The hook queries the `tblusers_clients` table to find the `auth_user_id` linked to the `client_id` being updated.

3. **Email Synchronization:**
- If a relationship exists, the email in `tblusers` is updated to match the new email in `tblclients`.

---

## Example Database Relationship

Below is an example of the relationship between `tblclients`, `tblusers`, and `tblusers_clients`:

### `tblclients`
| id  | userid | email           |
| ----|--------|-----------------|
| 1   | 1      | client1@domain.com |

### `tblusers`
| id  | email                |
| ----|----------------------|
| 1   | client1@domain.com   |

### `tblusers_clients`
| id  | auth_user_id | client_id |
| ----|--------------|-----------|
| 1   | 1            | 1         |

---

## Logging

The hook logs activities for auditing. To enable logging, uncomment the `logActivity` line in the hook file.

---

## Troubleshooting

- **Email Not Updating in `tblusers`:**
- Ensure the `tblusers_clients` table correctly maps `client_id` to `auth_user_id`.
- Check for database errors in the WHMCS activity logs.

- **Hook Not Executing:**
- Verify that the file is in the `includes/hooks` directory.
- Ensure your WHMCS installation has hooks enabled.

---

## License

This project is open-source and available under the MIT License. See the [LICENSE](LICENSE) file for details.

This README.md is designed to be clear and user-friendly for anyone interested in using or contributing to the project. Let me know if you’d like additional adjustments!
