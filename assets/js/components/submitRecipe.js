import React, { Component } from 'react';
import axios from 'axios';

class submitRecipe extends Component {

    constructor(props) {
        super(props)

        this.onChangeName = this.onChangeName.bind(this);
        this.onChangeDescription = this.onChangeDescription.bind(this);
        this.onSubmit = this.onSubmit.bind(this);

        this.state = {
            name: '',
            description: ''
        }
    }

    onChangeName(e) {
        this.setState({ name: e.target.value })
    }

    onChangeDescription(e) {
        this.setState({ description: e.target.value })
    }

    onSubmit(e) {
        e.preventDefault();

        const recipeObject = {
            name: this.state.name,
            description: this.state.description
        };

        axios.post('http://localhost:8000/api/recipe/submit', recipeObject)
            .then((res) => {
                console.log(res.data)
            }).catch((error) => {
            console.log(error)
        });

        this.setState({ name: '', description: '' })
    }


    render() {
        return (
            <div className="wrapper">
                <form onSubmit={this.onSubmit}>
                    <div className="form-group">
                        <label>Name</label>
                        <input type="text" value={this.state.name} onChange={this.onChangeName} className="form-control" />
                    </div>
                    <div className="form-group">
                        <label>Description</label>
                        <input type="text" value={this.state.email} onChange={this.onChangeDescription} className="form-control" />
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