-- Database untuk Aplikasi Kuesioner Skala Likert

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE kuesioner (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE pertanyaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kuesioner_id INT,
    teks_pertanyaan TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kuesioner_id) REFERENCES kuesioner(id) ON DELETE CASCADE
);

CREATE TABLE jawaban (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pertanyaan_id INT,
    responden_id INT,
    nilai INT NOT NULL, -- Skala Likert (1-5)
    komentar TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pertanyaan_id) REFERENCES pertanyaan(id) ON DELETE CASCADE
);