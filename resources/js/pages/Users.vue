<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
            <!-- Add user -->
            <button type="button" class="mb-2 btn btn-primary" data-toggle="modal" data-target="#userFormModal">
                Add New User
            </button>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered Date</th>
                <th>Role</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="userFormModal"
    data-backdrop="static"
    tabindex="-1"
    role="dialog"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            <span>Edit User</span> &nbsp;
            <span>Add New User</span>
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <Form @submit="createUser" :validation-schema="schema" v-slot="{ errors }">
            <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                            <Field name="name" type="text" :class="{'is-invalid' : errors.name }" class="form-control" id="name" aria-describedby="" placeholder="Name"></Field>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                            <Field name="email" type="email" :class="{'is-invalid' : errors.email }" class="form-control" id="email" aria-describedby="" placeholder="Email"></Field>
                        <span class="invalid-feedback">{{ errors.email }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                            <Field name="password" type="password" :class="{'is-invalid' : errors.password }" class="form-control" id="password" aria-describedby="" placeholder="Password"></Field>
                        <span class="invalid-feedback">{{ errors.password }}</span>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancel
            </button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </Form>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="deleteUserModal"
    data-backdrop="static"
    tabindex="-1"
    role="dialog"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            <span>Delete User</span>
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Are you sure you want to delete this user ?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cancel
          </button>
          <button type="button" class="btn btn-primary">Delete User</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import { onMounted,ref,reactive } from "vue";
import axios from 'axios'
import { Form,Field } from "vee-validate";
import * as yup from "yup";
import Swal from "sweetalert2";

    const users = ref([]);
  
    const getUsers = () => {
        axios.get('/api/users').then((response) => {
            users.value = response.data
        });
    }

    const createUser = (values, { resetForm }) => {
        axios.post('/api/users',values).then((response) => {
            
            users.value.unshift(response.data);
            $('#userFormModal').modal('hide');
            resetForm();
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "success",
            title: "User created successfully"
            });
        });
    }

    const schema = yup.object({
        name : yup.string().required(),
        email : yup.string().email().required(),
        password : yup.string().required().min(8)
    });
    onMounted(() => {
        getUsers();
    });
</script>
