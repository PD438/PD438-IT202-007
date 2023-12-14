CREATE TABLE liked_recipes (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    id INT,
    RecipeID INT,
    liked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (RecipeID) REFERENCES recipes(RecipeID)
);