import React, {Component} from 'react';
import {Route, Switch,Redirect, Link, withRouter} from 'react-router-dom';
import Machines from './Machines';
import Login from './Login';

class Home extends Component {
    
    render() {
        return (
           <div>
               <nav className="navbar navbar-expand-lg navbar-dark">
                   <Link className={"navbar-brand"} to={"/"}> Machine Gallery </Link>
                   <div className="collapse navbar-collapse" id="navbarText">
                       <ul className="navbar-nav mr-auto">
                           <li className="nav-item">
                                <Link className={"nav-link"} to={"/machines"}> Machines</Link>
                           </li>
    
                           <li className="nav-item">
                               <Link className={"nav-link"} to={"/login"}> Login</Link>
                           </li>
                       </ul>
                   </div>
               </nav>
               <Switch>
                   <Redirect exact from="/" to="/machines" />
                   <Route path="/machines" component={Machines} />
                   <Route path="/login" component={Login} />
               </Switch>
           </div>
        )
    }
}
    
export default Home;