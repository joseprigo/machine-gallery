import React, {Component} from 'react';
import {Route, Switch,Redirect, Link, withRouter} from 'react-router-dom';
    
class Login extends Component {
    
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: '',
            emailError: '',
            passwordError: '',
            successMessage: '',
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    // because our form inputs' names are the same
    // as our state names, we can just use them as the state names
    handleChange(event) {
        this.setState({
            
        });
    }

    handleSubmit(e) {
        e.preventDefault();

        $.ajax({
            url: 'http://machine-gallery.local/security/login',
            type: 'POST',
            data: {

            },
            dataType: 'json',
            success: function(response) {
                this.setState({
                    emailError: response.emailError ? response.emailError : null,
                    passwordError: response.passwordError ? response.passwordError : null,
                    successMessage: response.success_message ? response.success_message : null,
                });
            }.bind(this),
            error: function(xhr) {
                console.log(`An error occured: ${xhr.status} ${xhr.statusText}`);
            }
        });
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                <div className="container">
                    <div className="row">
                        <div className="col-md-3 form-group">
                            <label htmlFor="email">Email</label>
                            <input className="form-control" type="email" name='email' value={this.state.email} onChange={this.handleChange} id="email" placeholder="Email" />
                            <small>{this.state.emailError}</small>
                        </div>
                        <div className="col-md-3 form-group">
                            <label htmlFor="password">Password</label>            
                            <input className="form-control" type="password" name='password' value={this.state.password} onChange={this.handleChange} id="password" placeholder="Password" />
                            <small>{this.state.passwordError}</small>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md3">
                            <button className="btn btn-default" type="submit">Enter</button>
                            <span className='text-success'>{this.state.successMessage}</span>
                        </div>
                    </div>

                </div>
            </form>
        );
    }
}
    
export default Login;