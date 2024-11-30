# Medical Center Appointment System

This is a Laravel-based Medical Center Appointment Management System. It allows patients to book appointments with doctors,
confirm their appointments, manage their appointments, and update their profile information, can also pay for their appointments,
patients can also add their feedback.

## Features

- **Patient Management**: Patients can register, login, and manage their profile, including editing personal information.
- **Doctor Management**: Doctors can register, login, and manage their profile, including editing personal information.
- **Appointment Booking**: Patients can book an appointment with a doctor.
- **Appointment Confirmation**: Doctors can confirm or cancel appointments.
- **Profile Management**: Both patients and doctors can update their profile information (name, email, etc.).

### Users Table (`users`)

The `users` table holds both doctors and patients. The `role` column is used to distinguish between the two.

```sql
CREATE TABLE `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('doctor', 'patient') DEFAULT 'patient',
    `phone` VARCHAR(15),
    `image` VARCHAR(255),
    `dob` DATE,
    `gender` ENUM('male', 'female', 'other'),
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL
);



### Appointments Table (`appointments`)

The `appointments` table stores information about appointments between doctors and patients. The table contains details such as the appointment date, status, and payment method. It also creates foreign key relationships with the `users` table to reference the doctor and patient.

```sql
CREATE TABLE `appointments` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `doctor_id` INT UNSIGNED NOT NULL,
    `patient_id` INT UNSIGNED NOT NULL,
    `appointment_date` DATETIME NOT NULL,
    `status` ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    `payment_method` ENUM('visa', 'cash') DEFAULT 'cash',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

This provides a clear explanation of the `appointments` table and how it relates to the `users` table within your database schema.
