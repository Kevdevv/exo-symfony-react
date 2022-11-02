import React from 'react'
import { Route, Routes, Navigate, Link, withRouter, useParams } from 'react-router-dom';
import Users from '../components/users';
import Possession from '../components/possession';
import FormModal from '../components/FormModal';


const home = () => {
  return (
      <div>
          <Routes>
              <Route path="/" element={<Users />} />
              <Route path="possession/:id" element={<Possession />} />
          </Routes>
      </div>
  )
}

export default home