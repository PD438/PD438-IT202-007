CREATE TABLE Recipes (
    RecipeID INT PRIMARY KEY,
    Title VARCHAR(255),
    ImageURL VARCHAR(255),
    ImageType VARCHAR(10),
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ModifiedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Recipes (RecipeID, Title, ImageURL, ImageType)
VALUES
    (1079930, 'Crock Pot Pasta Bolognese Sauce', 'https://spoonacular.com/recipeImages/1079930-312x231.jpg', 'jpg'),
    (474589, 'Crockpot Turkey Bolognese Pasta Sauce', 'https://spoonacular.com/recipeImages/474589-312x231.jpg', 'jpg'),
    (543261, 'Crock Pot Meaty Pasta Sauce', 'https://spoonacular.com/recipeImages/543261-312x231.jpg', 'jpg');
