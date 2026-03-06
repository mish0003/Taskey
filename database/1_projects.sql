CREATE TABLE projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    description TEXT
);
INSERT INTO projects(title, description) VALUES
    ('The Fellowship', 'Formation and early journey of the Fellowship'),
    ('The Two Towers', 'War against Saruman and the pursuit of the hobbits'),
    ('The Return of the King', 'Final battles against Sauron');
