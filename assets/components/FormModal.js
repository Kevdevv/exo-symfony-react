import React, { useState } from 'react';
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';


const FormModal = () => {

    const [show, setShow] = useState(false);
<<<<<<< HEAD
    console.log('test')
    console.log('test')
    console.log('test')
    console.log('test')
    console.log('test')
=======
    console.log('conflict')
    console.log('conflict')
    console.log('conflict')
    console.log('conflict')
    console.log('conflict')
>>>>>>> main


    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const [addFormData, setAddFormData] = useState();

    const handleAddFormChange = (event) => {
        event.preventDefault();

        const fieldName = event.target.getAttribute("name");
        const fieldValue = event.target.value;

        const newFormData = { ...addFormData };
        newFormData[fieldName] = fieldValue;

        setAddFormData(newFormData);
    }

    const handleAddFormSubmit = (event) => {
        event.preventDefault();
        const AddRow = {
            name: addFormData.name,
            birthDate: addFormData.birthDate,
            firstname: addFormData.firstname,
            mail: addFormData.mail,
            address: addFormData.address,
            phone: addFormData.phone,
        }

        try {
            fetch('http://localhost:8000/api/users',
                {
                    method: "POST",
                    headers: {
                        "Content-type": "application/ld+json",
                        'accept': 'application/ld+json'
                    },
                    body: JSON.stringify(AddRow)
                })
                .then(response => {
                    if (!response.ok) {
                        setError(`This is an HTTP error: The status is ${response.status}`);
                        throw new Error(
                            `This is an HTTP error: The status is ${response.status}`
                        );
                    }
                })
                .then(data => {
                    window.location.reload();
                });

        } catch (err) {
            setError(err.message);
        }
    }

  return (
      <>
          <Button variant="primary" onClick={handleShow}>
              Ajouter un utilisateur
          </Button>

          <Modal
              show={show}
              onHide={handleClose}
              backdrop="static"
              keyboard={false}
          >
              <Modal.Header closeButton>
                  <Modal.Title>Ajouter un utilisateur</Modal.Title>
              </Modal.Header>
              <Modal.Body>
                  <form onSubmit={handleAddFormSubmit}>
                      <div className="mb-3">
                          <label for="exampleInputEmail1" className="form-label">Email</label>
                          <input name="mail" type="email" className="form-control" id="1" aria-describedby="emailHelp" onChange={handleAddFormChange} />
                      </div>
                      <div className="mb-3">
                          <label for="exampleInputPassword1" className="form-label">Nom</label>
                          <input name="name" type="text" className="form-control" id="2" aria-describedby="emailHelp" onChange={handleAddFormChange} />
                      </div>
                      <div className="mb-3">
                          <label for="exampleInputPassword1" className="form-label">Prénom</label>
                          <input name="firstname" type="text" className="form-control" id="3" aria-describedby="emailHelp" onChange={handleAddFormChange} />
                      </div>
                      <div className="mb-3">
                          <label for="exampleInputPassword1" className="form-label">Téléphone</label>
                          <input name="phone" type="text" className="form-control" id="4" aria-describedby="emailHelp" onChange={handleAddFormChange} />
                      </div>
                      <div className="mb-3">
                          <label for="exampleInputPassword1" className="form-label">Adresse</label>
                          <input name="address" type="text" className="form-control" id="5" aria-describedby="emailHelp" onChange={handleAddFormChange} />
                      </div>
                      <div className="mb-3">
                          <label for="exampleInputPassword1" className="form-label">Date de naissance</label>
                          <input name="birthDate" type="date" className="form-control" id="6" aria-describedby="emailHelp" onChange={handleAddFormChange} />
                      </div>
                      <button type="submit" className="btn btn-primary">Envoyer</button>
                  </form>
              </Modal.Body>
          </Modal>
      </>
  )
}

export default FormModal
