import React, {Component} from 'react';
import axios from 'axios';

class viewRecipe extends Component {
    constructor() {
        super();
        this.state = { recipe:[], loading: true, params :[]};
    }

    componentDidMount() {
        this.getRecipe();
    }

    getRecipe() {
        axios.get(`http://localhost:8000/api/recipe/`+ this.state.params.id)
            .then(recipe => {this.setState({ recipe: recipe.data || [], loading: false})
                .catch(err => console.log('err', err));
            });
        console.log(this.state.recipe);
    }

    render() {
        const loading = this.state.loading;
        this.state.params = this.props.match.params;
        return(
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Recipe in detail</span>Created by Shanthini Rajarathinam </h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                { this.state.recipe.map(recipe =>
                                    <div className="col-md-10 offset-md-1 row-block" key={recipe.id}>
                                        <div className="media">
                                            <div className="media-left align-self-center">
                                                <img className="rounded-circle"
                                                     src={recipe.imageURL}/>
                                            </div>
                                            <div className="media-body">
                                                <h4>{recipe.name}</h4>
                                                <p>{recipe.description}</p>
                                            </div>
                                        </div>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </div>
        )
    }
}
export default viewRecipe;