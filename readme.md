# Aplikasi Kuesioner Skala Likert - CodeIgniter 3 & Tailwind CSS

## Struktur Database

```sql
-- Tabel pengguna
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

-- Tabel kuesioner
CREATE TABLE surveys (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  start_date DATE,
  end_date DATE,
  status ENUM('draft', 'active', 'closed') NOT NULL DEFAULT 'draft',
  created_by INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel pertanyaan kuesioner
CREATE TABLE questions (
  id INT(11) NOT NULL AUTO_INCREMENT,
  survey_id INT(11) NOT NULL,
  question_text TEXT NOT NULL,
  question_order INT(11) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (survey_id) REFERENCES surveys(id) ON DELETE CASCADE
);

-- Tabel opsi jawaban skala likert
CREATE TABLE likert_scales (
  id INT(11) NOT NULL AUTO_INCREMENT,
  survey_id INT(11) NOT NULL,
  scale_value INT(11) NOT NULL,
  scale_label VARCHAR(100) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (survey_id) REFERENCES surveys(id) ON DELETE CASCADE
);

-- Tabel responden
CREATE TABLE respondents (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100),
  email VARCHAR(100),
  phone VARCHAR(20),
  additional_info TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

-- Tabel respon kuesioner
CREATE TABLE responses (
  id INT(11) NOT NULL AUTO_INCREMENT,
  survey_id INT(11) NOT NULL,
  respondent_id INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (survey_id) REFERENCES surveys(id) ON DELETE CASCADE,
  FOREIGN KEY (respondent_id) REFERENCES respondents(id) ON DELETE CASCADE
);

-- Tabel detail jawaban
CREATE TABLE answer_details (
  id INT(11) NOT NULL AUTO_INCREMENT,
  response_id INT(11) NOT NULL,
  question_id INT(11) NOT NULL,
  answer_value INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (response_id) REFERENCES responses(id) ON DELETE CASCADE,
  FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);
```

## Struktur Direktori CodeIgniter 3

```
application/
  config/
    routes.php (Custom routes)
    autoload.php (Autoload libraries, helpers)
    database.php (Database configuration)
  controllers/
    Auth.php (Login/logout functionality)
    Dashboard.php (Admin dashboard)
    Surveys.php (Survey management)
    Questions.php (Question management)
    Reports.php (Survey reports)
    Respondent.php (Public survey form)
  models/
    User_model.php
    Survey_model.php
    Question_model.php
    Response_model.php
    Report_model.php
  views/
    templates/
      header.php
      footer.php
      sidebar.php
    auth/
      login.php
    dashboard/
      index.php
    surveys/
      index.php
      create.php
      edit.php
    questions/
      index.php
      create.php
      edit.php
    reports/
      index.php
      detail.php
    public/
      survey_form.php
      thank_you.php
  helpers/
    custom_helper.php
assets/
  css/
    tailwind.css
  js/
    app.js
.htaccess
index.php
```

## Fitur Aplikasi

### 1. Dashboard Admin
- Login/logout admin
- Manajemen kuesioner (tambah, edit, hapus, aktifkan/nonaktifkan)
- Manajemen pertanyaan (tambah, edit, hapus, ubah urutan)
- Kustomisasi skala Likert (jumlah skala dan label)
- Lihat laporan hasil kuesioner

### 2. Halaman Publik
- Form untuk mengisi kuesioner
- Halaman terima kasih setelah mengisi kuesioner

### 3. Laporan
- Statistik dasar (jumlah responden, rata-rata per pertanyaan)
- Visualisasi data (grafik distribusi jawaban)
- Ekspor data ke Excel/CSV