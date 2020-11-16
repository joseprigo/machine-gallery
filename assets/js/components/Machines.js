import React, {Component} from 'react';
import {Route, Switch,Redirect, Link, withRouter} from 'react-router-dom';
import axios from 'axios';
 
class Machines extends Component {
    constructor() {
        super();
        this.max = 3000;
        this.state = { machines: [], loading: true, search: '', min:0, max: this.max};
    }
    
    componentDidMount() {
        this.getMachines();
    }
    
    getMachines() {
       axios.get(`http://machine-gallery.local/machine/list`).then(machines => {
           this.setState({ machines: machines.data, loading: false})
       })
    }
    updateSearch(event) {
        this.setState({search:event.target.value});
        
    }
    updateMax(event) {
        if(event.target.value == '' || event.target.value<= 0) event.target.value = this.max;
        this.setState({max:event.target.value});
    }
    updateMin(event) {
        if(event.target.value > this.state.max) event.target.value = this.state.max;
        this.setState({min:event.target.value});
    }
    
    render() {
        const loading = this.state.loading;
        let filteredMachines = this.state.machines.filter(
            (machine) => {
                return machine.model.indexOf(this.state.search) !== -1 ||
                machine.brand.indexOf(this.state.search) !== -1 ||
                machine.manufacturer.indexOf(this.state.search) !== -1;
            }).filter(
            (machine) => {
                return machine.price <= this.state.max && machine.price >= this.state.min;
            });
        return(
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Our machines</span>Find second hand machines at the best price and highest quality standards</h2>
                            
                        </div>
                        <div className="row">
                            <div className="col-md-6 ">
                                <div className="form-group">
                                    <input type="text"
                                className="form-control"
                            placeholder="filder by model, brand, manufacturer ..."
                            value={this.state.search}
                            onChange={this.updateSearch.bind(this)}
                            />
                                </div>
                                
                            </div>
                            <div className="col-md-2">
                                    <i className="fa fa-search"></i>
                                 </div>
                            
                        </div>
                        <div className="row">
                        <div className="col-md-1">
                            min
                        </div>
                        <div className="col-md-2 ">
                            <div className="form-group">
                                <input type="number" 
                                value={this.state.min}
                            onChange={this.updateMin.bind(this)}
                                className="form-control"
                                />
                            </div>
                        </div>
                         <div className="col-md-1">
                            max
                        </div>
                        <div className="col-md-2">
                            <div className="form-group">
                                <input type="number" 
                                value={this.state.max}
                            onChange={this.updateMax.bind(this)}
                                className="form-control"
                                />
                            </div>
                        </div>
                        <div className="col-md-2">
                            €
                        </div>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                { filteredMachines.map(machine =>
                                    <div className="col-md-3" key={machine.id}>
                                    <img className="" src={machine.images[0].url}/>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                   
                                                    <div className="media-body">
                                                        <h4>{machine.model}</h4>
                                                        <p> Brand: {machine.brand}</p>
                                                        <p> Manufacturer: {machine.manufacturer}</p>
                                                        <p> {machine.price} €</p>
                                                       
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
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
export default Machines;