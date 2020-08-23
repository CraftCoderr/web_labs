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