// ./assets/js/components/Home.js

import React, { Component } from 'react';
import { Route, Routes, Navigate, Link, withRouter } from 'react-router-dom';
import Users from '../components/users';
import Possession from '../components/possession';

class Home extends Component {

    render() {
        return (
            <div>
                <Routes>
                    <Route path="/" element={<Users />} />
                    <Route path="/possession" element={<Possession />} />
                </Routes>
            </div>
        )
    }
}

export default Home;
