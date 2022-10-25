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
                <table>
                {this.state.users.map(user => 
                  <tr>
                    <td>
                        {user.name}
                    </td>
                    <td>
                        {user.firstname}
                    </td>
                    <td>
                        {user.mail}
                    </td>
                    <td>
                        {user.address}
                    </td>
                    <td>
                        {user.phone}
                    </td>
                  </tr>  
                )}
                </table>
            </div>
            
        )
    }
}

export default Home;
