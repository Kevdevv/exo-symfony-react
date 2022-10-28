import { useParams } from "react-router-dom";
import axios from 'axios';
import { useEffect, useState } from 'react'
import React from 'react'




const possession = () => {
    let { id } = useParams();
    const client = axios.create({
        baseURL: (`http://localhost:8000/api/users/` + id)
    });

    const [possession, setPossession] = useState([]);

    useEffect(() => {
        client.get().then((response) => {
            setPossession(response.data.possessions);
        });
    }, []);

    return (
        <div>
            <h3>test</h3>
            {possession.map((poss) => {
                return <p>{poss.name}</p>
            })}
        </div>
    )
}

export default possession