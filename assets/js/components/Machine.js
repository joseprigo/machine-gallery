import React, {Component} from 'react';
import axios from 'axios';
    
class Machine extends Component {
    constructor() {
        super();
        this.state = { machine: [], loading: true};
    }
    
    componentDidMount() {
        this.getMachine();
    }
    
    getMachine() {
       axios.get(`http://machine-gallery.local/machine/list`).then(machine => {
           this.setState({ machine: machine.data, loading: false})
       })
    }
    
    render() {
        const loading = this.state.loading;
        return(
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>S</span>Description</h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                
                            </div>
                        )}
                    </div>
                </section>
            </div>
        )
    }
}
export default Machine;