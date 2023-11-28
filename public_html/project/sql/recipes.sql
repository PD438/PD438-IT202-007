CREATE TABLE recipes (
    RecipeID INT PRIMARY KEY,
    Title VARCHAR(255),
    ImageURL VARCHAR(255),
    ImageType VARCHAR(10),
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ModifiedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);