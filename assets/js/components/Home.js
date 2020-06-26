import React, {Component} from 'react';
import {Route, Switch,Redirect, Link, withRouter} from 'react-router-dom';
import Recipes from './Recipes';
import viewRecipe from './viewRecipe';

class Home extends Component {

    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <Link className={"navbar-brand"} to={"/"}> Meal Planner </Link>
                    <div className="collapse navbar-collapse" id="navbarText">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/recipes"}> Recipes </Link>
                            </li>
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/submitRecipe"}> Submit Recipe </Link>
                            </li>
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/mealPlan"}> Plan your Meal </Link>
                            </li>
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/shoppingList"}> Shopping List </Link>
                            </li>
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/admin"}> Admin </Link>
                            </li>
                        </ul>
                        <form className="navbar-form navbar-left" action="/search">
                            <div className="input-group">
                                <input type="text" className="form-control" placeholder="Search" name="search"/>
                                    <div className="input-group-btn">
                                        <button className="btn btn-default" type="submit">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                 data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 512 512"
                                                 className="svg-inline--fa fa-search fa-w-16 fa-fw">
                                                <path fill="currentColor"
                                                      d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"
                                                      className=""></path>
                                            </svg>
                                        </button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </nav>
                {<Switch>
                    <Redirect exact from="/" to="/recipes" />
                    <Route path="/recipes" component={Recipes} />
                    <Route path="/viewRecipe/:id" component={viewRecipe} />
                    {/*<Route path="/posts" component={Posts} />*/}
                </Switch>}
            </div>
        )
    }
}

export default Home;