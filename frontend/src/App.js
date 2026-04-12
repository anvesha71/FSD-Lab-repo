import {useState,useEffect} from "react";
import axios from "axios";
import "./App.css";

import rat from "./assets/rat.png";
import wizard from "./assets/wizard.png";
import chest from "./assets/chest.png";
import parchment from "./assets/parchment.png";
import bg from "./assets/bg.png";

function App(){

const [book,setBook]=useState({
name:"",
isbn:"",
title:"",
author:"",
publisher:""
});

const [data,setData]=useState([]);

const handleChange=(e)=>{
setBook({...book,[e.target.name]:e.target.value});
};

const addBook=()=>{
axios.post("http://localhost:5000/addBook",book)
.then(()=>getBooks());
};

const deleteBook=(isbn)=>{
axios.delete(`http://localhost:5000/delete/${isbn}`)
.then(()=>getBooks());
};

const getBooks=()=>{
axios.get("http://localhost:5000/books")
.then(res=>setData(res.data));
};

useEffect(()=>{
getBooks();
},[]);

return(
<div className="app">

<h1 className="title">Dungeon Library</h1>

<div className="form-wrapper">

<img src={wizard} className="wizard"/>

<div className="form">

<label>📜 Tome Name</label>
<input name="name" onChange={handleChange}/>

<label>🔢 Archive ID</label>
<input name="isbn" onChange={handleChange}/>

<label>✨ Spell Title</label>
<input name="title" onChange={handleChange}/>

<label>🧙 Author Wizard</label>
<input name="author" onChange={handleChange}/>

<label>🏰 Guild / Publisher</label>
<input name="publisher" onChange={handleChange}/>

<button onClick={addBook}>Add to Vault</button>

</div>
</div>

<div className="list">
{data.map(b=>(
<div className="card" key={b._id}>

<img src={chest} className="chest"/>

<h3>{b.name}</h3>
<p>Wizard: {b.author}</p>
<p>ID: {b.isbn}</p>

<button onClick={()=>deleteBook(b.isbn)}>
Remove
</button>

</div>
))}
</div>

<img src={rat} className="rat"/>

</div>
);
}

export default App;