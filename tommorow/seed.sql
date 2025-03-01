CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255)
);

-- 
INSERT INTO users (name, email, password)
VALUES ('rwpl', 'rwpl@tommorow.example.com', 'sUp3r_Str0ng_RWPL_P@ssw0rd');
