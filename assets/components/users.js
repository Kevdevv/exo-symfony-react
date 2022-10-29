import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
class Users extends Component {
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

    deleteUser(id) {
        axios.delete(`http://localhost:8000/api/users/` + id).then(users => { this.getUsers() })

    }


    render() {
        return (
            <div>
                <h2>Liste des utilisateurs</h2>
                <table className="table">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Mail</th>
                            <th scope="col">adresse</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">delete</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                        {this.state.users.map((user) => {
                       return <tr>
                           <Link to={"possession/" + user.id}>                        
                            <td>{user.name}</td>
                            </Link>
                            <td>{user.firstname}</td>
                            <td>{user.mail}</td>
                            <td>{user.address}</td>
                            <td>{user.phone}</td>
                            <td><button onClick={() => this.deleteUser(user.id)} type="button" class="btn btn-danger">Supprimer</button></td>
                            {console.log(user.name)}                           
                        </tr>
                         })}
                        </tbody>                   
                 </table>                            
            </div>

        )
    }
}

export default Users;
