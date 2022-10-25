import React, { Component } from 'react';
import axios from 'axios';

class Home extends Component {
    constructor() {
        super();
        this.state = { users: [] };
    }

    componentDidMount() {
        this.getUsers();
    }

    getUsers() {
        axios.get(`http://localhost:8000/api/users`).then(users => {
            this.setState({ users: users.data, loading: false })
        })
    }

    render() {
        return (
            <div>
                <h1>Liste d'utilisateur</h1>
                {this.state.users.map(user => 
                    <div className="card" style={{"width": "18rem"}}>
                        <div className="card-body">
                            <p className="card-text">{user.name}</p>
                            <p className="card-text">{user.firstname}</p>
                            <p className="card-text">{user.mail}</p>
                            <p className="card-text">{user.address}</p>
                            <p className="card-text">{user.phone}</p>
                        </div>
                    </div>
                )}
            </div>
            
        )
    }
}

export default Home;
