import React, {Component} from 'react';
import axios from 'axios';
    
class Machines extends Component {
    constructor() {
        super();
        this.state = { users: [], loading: true};
    }
    
    componentDidMount() {
        this.getMachines();
    }
    
    getMachines() {
       axios.get(`http://machine-gallery.local/machine/list`).then(machines => {
           this.setState({ machines: machines.data, loading: false})
       })
    }
    
    render() {
        const loading = this.state.loading;
        return(
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Our machines</span>Find second hand machines at the best price and highest quality standards</h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                { this.state.machines.map(machine =>
                                    <div className="col-md-4 offset-md-1 row-block" key={machine.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-left align-self-center">
                                                        <img className="rounded-circle"
                                                             src={machine.images[0].url}/>
                                                    </div>
                                                    <div className="media-body">
                                                        <h4>{machine.model}</h4>
                                                        <p>{machine.brand} - {machine.manufacturer}</p>
                                                    </div>
                                                    <div className="media-right align-self-center">
                                                        <a href="#" className="btn btn-default">Contact Now</a>
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