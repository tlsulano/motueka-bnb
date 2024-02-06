
-- Create a new database for the bookstore
CREATE DATABASE BookstoreDB;
USE BookstoreDB;

-- Create a table for Authors
CREATE TABLE Authors (
    AuthorID INT PRIMARY KEY IDENTITY(1,1),
    Name NVARCHAR(100),
    Bio TEXT
);

-- Create a table for Categories
CREATE TABLE Categories (
    CategoryID INT PRIMARY KEY IDENTITY(1,1),
    CategoryName NVARCHAR(50)
);

-- Create a table for Books
CREATE TABLE Books (
    BookID INT PRIMARY KEY IDENTITY(1,1),
    Title NVARCHAR(200),
    AuthorID INT,
    CategoryID INT,
    ISBN NVARCHAR(20),
    Price DECIMAL(10, 2),
    PublicationDate DATE,
    FOREIGN KEY (AuthorID) REFERENCES Authors(AuthorID),
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
);
