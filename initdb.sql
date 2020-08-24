CREATE TABLE test_result(
                            test_id INT AUTO_INCREMENT,
                            date DATETIME,
                            full_name VARCHAR(255),
                            student_group VARCHAR(255),
                            answer1 VARCHAR(255),
                            answer2 VARCHAR(255),
                            answer3 VARCHAR(255),
                            result BOOLEAN,
                            PRIMARY KEY (test_id)
);

CREATE TABLE blog_post(
    post_id INT AUTO_INCREMENT,
    date DATETIME,
    title VARCHAR(255),
    image VARCHAR(255),
    text TEXT,
    PRIMARY KEY (post_id)
);

CREATE TABLE `user`(
  user_id INT AUTO_INCREMENT,
  username VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  fio VARCHAR(255),
  is_admin BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (user_id),
  UNIQUE (username),
  UNIQUE (email)
);

CREATE TABLE website_view(
    view_id INT AUTO_INCREMENT,
    date DATETIME,
    page VARCHAR(255),
    ip_address VARCHAR(255),
    hostname VARCHAR(255),
    browser VARCHAR(255),
    PRIMARY KEY (view_id)
);