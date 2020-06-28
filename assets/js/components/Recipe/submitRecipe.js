import React, { Component } from 'react';
import axios from 'axios';

class submitRecipe extends Component {

    constructor(props) {
        super(props);
        this.onChangeName = this.onChangeName.bind(this);
        this.onChangeDescription = this.onChangeDescription.bind(this);
        this.onChangeIngredients = this.onChangeIngredients.bind(this);
        this.onSubmit = this.onSubmit.bind(this);

        this.state = {
            name: '',
            description: '',
            ingredients: '',
            message: '',
            showResult: false
        }
    }

    onChangeName(e) {
        this.setState({ name: e.target.value })
    }

    onChangeDescription(e) {
        this.setState({ description: e.target.value })
    }

    onChangeIngredients(e) {
        this.setState({ ingredients: e.target.value })
    }

    onSubmit(e) {
        e.preventDefault();

        const recipeObject = {
            name: this.state.name,
            description: this.state.description,
            ingredients: this.state.ingredients
        };

        axios.post('http://localhost:8000/api/recipe/submit', recipeObject)
            .then((res) => {
                this.setState({ message: res.data.status, showResult: true });
                console.log(res.data)
            }).catch((error) => {
            console.log(error)
        });

        this.setState({ name: '', description: '', ingredients: '' })
    }


    render() {
        return (
            <div className="wrapper">
                <div className={`result alert alert-success ${this.state.showResult == true? 'active': ''}`}>{ this.state.message }</div>
                <form onSubmit={this.onSubmit}>
                    <div className="form-group">
                        <label>Name</label>
                        <input type="text" value={this.state.name} onChange={this.onChangeName} className="form-control" />
                    </div>
                    <div className="form-group">
                        <label>Description</label>
                        <input type="text" value={this.state.description} onChange={this.onChangeDescription} className="form-control" />
                    </div>
                    <div className="form-group">
                        <label>Ingredients</label>
                        <input type="text" value={this.state.ingredients} onChange={this.onChangeIngredients} className="form-control" />
                    </div>
                    <div className="form-group">
                        <input type="submit" value="Submit Recipe" className="btn btn-block submit" />
                    </div>
                </form>
            </div>
        )
    }
}
export default submitRecipe;