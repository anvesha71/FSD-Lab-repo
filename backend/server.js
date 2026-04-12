const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

const app = express();

app.use(cors());
app.use(express.json());

mongoose.connect("mongodb://127.0.0.1:27017/library");

const BookSchema = new mongoose.Schema({
name:String,
isbn:String,
title:String,
author:String,
publisher:String
});

const Book = mongoose.model("Book",BookSchema);

// insert
app.post("/addBook", async (req,res)=>{
const book = new Book(req.body);
await book.save();
res.send("Book Added");
});

// get
app.get("/books", async (req,res)=>{
const books = await Book.find();
res.json(books);
});

// delete
app.delete("/delete/:isbn", async (req,res)=>{
await Book.findOneAndDelete({isbn:req.params.isbn});
res.send("Deleted");
});

// update
app.put("/update/:isbn", async (req,res)=>{
await Book.findOneAndUpdate(
{isbn:req.params.isbn},
req.body
);
res.send("Updated");
});

app.listen(5000,()=>console.log("Server running"));