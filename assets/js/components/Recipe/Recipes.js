import React, {Component} from 'react';
import axios from 'axios';
import {Link, Redirect, Route, Switch} from "react-router-dom";
import viewRecipe from './viewRecipe';

class Recipes extends Component {
    constructor() {
        super();
        this.state = { recipes: [], loading: true};
    }

    componentDidMount() {
        this.getRecipes();
    }

    getRecipes() {
        axios.get(`http://localhost:8000/api/recipes`)
            .then(recipes => {this.setState({ recipes: recipes.data || [], loading: false})
            .catch(err => console.log('err', err));
        });
        console.log(this.state.recipes);
    }

    render() {
        const loading = this.state.loading;

        return(
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>List of Recipes</span>Created by Shanthini Rajarathinam </h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                { this.state.recipes.map(recipe =>
                                    <div className="col-md-10 offset-md-1 row-block" key={recipe.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-left align-self-center">
                                                        <img className="rounded-circle"
                                                             src={recipe.imageURL}/>
                                                    </div>
                                                    <div className="media-body">
                                                        <h4>{recipe.name}</h4>
                                                        <p>{recipe.description}</p>
                                                    </div>
                                                    <div className="media-right align-self-center">
                                                        <Link className={"btn btn-default"} to={"/viewRecipe/"+recipe.id}> View Full Recipe </Link>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                )}
                            </div>
                        )}
                        {<Switch>
                            <Redirect exact from="/" to="/recipes" />
                            <Route path="/viewRecipe/:id" component={viewRecipe} />
                        </Switch>}
                    </div>
                </section>
            </div>
        )
    }
}
export default Recipes;