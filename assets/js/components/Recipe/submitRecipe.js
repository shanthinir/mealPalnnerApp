import React, { Component } from 'react';
import axios from 'axios';

function ValidationMessage(props) {
    if (!props.valid) {
        return <div className='error-msg'>{props.message}</div>
    }
    return null;
}

class submitRecipe extends Component {

    constructor(props) {
        super(props);
        this.onChangeName = this.onChangeName.bind(this);
        this.onChangeDescription = this.onChangeDescription.bind(this);
        this.onChangeIngredients = this.onChangeIngredients.bind(this);
        this.onSubmit = this.onSubmit.bind(this);

        this.state = {
            name: '', validName: false,
            description: '', validDescription: false,
            ingredients: '',
            message: '',
            showResult: false,
            formValid: false,
            errorMsg: {}
        }
    }

    validateForm() {
        const {validName, validDescription} = this.state;
        this.setState({
            formValid: validDescription && validName
        })
    }

    validateRecipeName() {
        const {name} = this.state;
        let validName = true;
        let errorMsg = {...this.state.errorMsg};

        if (name.length < 3) {
            validName = false;
            errorMsg.name = 'Must be at least 5 characters long'
        }

        this.setState({validName, errorMsg}, this.validateForm)
    }

    validateRecipeDescription() {
        const {description} = this.state;
        let validDescription = true;
        let errorMsg = {...this.state.errorMsg};

        if (description.length < 10) {
            validDescription = false;
            errorMsg.description = 'Must be at least 10 characters long'
        }

        this.setState({validDescription, errorMsg}, this.validateForm)
    }

    onChangeName(e) {
        this.setState({ name: e.target.value }, this.validateRecipeName())
    }

    onChangeDescription(e) {
        this.setState({ description: e.target.value }, this.validateRecipeDescription())
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
                        <ValidationMessage valid={this.state.validName} message={this.state.errorMsg.name} />
                        <input type="text" value={this.state.name} onChange={this.onChangeName} className="form-control" />
                    </div>
                    <div className="form-group">
                        <label>Description</label>
                        <ValidationMessage valid={this.state.validDescription} message={this.state.errorMsg.description} />
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