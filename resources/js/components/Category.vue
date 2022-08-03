<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div
              class="
                bg-gradient-primary
                shadow-primary
                border-radius-lg
                pt-4
                pb-3
              "
            >
              <h6 class="text-white text-capitalize ps-3">Category table</h6>
            </div>
          </div>
          <div class="col-11 text-end">
            <a
              @click="openAdd()"
              data-bs-toggle="modal"
              data-bs-target="#staticBackdrop"
              class="btn bg-gradient-dark mb-0"
            >
              <i class="material-icons text-sm"> add </i>&nbsp;&nbsp; Add
              Category
            </a>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="filterTable">
                <thead>
                  <tr>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                      "
                    >
                      ID
                    </th>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                        ps-2
                      "
                    >
                      Category Name
                    </th>
                    <th
                      class="
                        text-center text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                      "
                    >
                      Show/Hide
                    </th>
                    <th class="text-secondary opacity-7"></th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody v-if="categories != ''">
                  <tr
                    v-for="(category, index) in categories"
                    v-bind:key="index"
                  >
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="justify-content-center">
                          {{ category.category_id }}
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">
                        {{ category.category_name }}
                      </p>
                    </td>

                    <td
                      class="align-middle text-center"
                      v-if="category.category_status == 1"
                    >
                      <a
                        type="button"
                        @click="inactiveCategory(category.category_id)"
                      >
                        <i
                          class="material-icons"
                          style="font-size: 40px; color: green"
                        >
                          thumb_up
                        </i>
                      </a>
                    </td>

                    <td class="align-middle text-center" v-else>
                      <a
                        type="button"
                        @click="activeCategory(category.category_id)"
                      >
                        <i
                          class="material-icons"
                          style="font-size: 40px; color: red"
                        >
                          thumb_down
                        </i>
                      </a>
                    </td>
                    <td class="align-middle">
                      <a
                        type="button"
                        @click="editCategory(category)"
                        data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"
                        class="font-weight-bold"
                        data-toggle="tooltip"
                      >
                        <i class="material-icons" style="font-size: 30px">
                          edit
                        </i>
                      </a>
                    </td>
                    <td class="align-middle">
                      <a
                        type="button"
                        @click="deleteCategories(category.category_id)"
                        class="font-weight-bold"
                        data-toggle="tooltip"
                      >
                        <i class="material-icons" style="font-size: 30px">
                          delete
                        </i>
                      </a>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <td colspan="5">
                    <center>
                      <h3>Nothing here</h3>
                    </center>
                  </td>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div div="row">
          <ul class="pagination pagination-lg justify-content-center">
            <li
              class="page-item"
              v-bind:class="[{ disabled: !pagination.prev_page_url }]"
              :disable="!pagination.prev_page_url"
            >
              <a
                class="page-link"
                href="#"
                @click="fetchCategories(pagination.prev_page_url)"
                rel="prev"
                aria-label="&laquo; Previous"
                >&lsaquo;</a
              >
            </li>

            <li class="page-item disabled">
              <a
                class="
                  page-link
                  active
                  rounded-0
                  mr-3
                  shadow-sm
                  border-top-0 border-left-0
                "
                href="#"
              >
                {{ pagination.current_page }} / {{ pagination.last_page }}
              </a>
            </li>

            <li
              class="page-item"
              v-bind:class="[{ disabled: !pagination.next_page_url }]"
              :disable="!pagination.next_page_url"
            >
              <a
                class="page-link"
                href="#"
                @click="fetchCategories(pagination.next_page_url)"
                rel="next"
                aria-label="Next &raquo;"
                >&rsaquo;</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="staticBackdrop"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <form @submit.prevent="saveCategory">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                Category: #{{ category.category_id }}
              </h5>
              <a type="button">
                <i class="material-icons text-xl" data-bs-dismiss="modal"
                  >close</i
                >
              </a>
            </div>
            <div class="modal-body">
              <div
                class="input-group input-group-outline my-3"
                :class="{ 'focused is-focused': focusAll }"
              >
                <label class="form-label"> Category Name </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="category.category_name"
                />
              </div>
              <span style="color: red" v-if="errors && errors.category_name">
                {{ errors.category_name[0] }}
              </span>
              <br />
              <label class="form-label"> Category Desc </label>
              <div class="input-group input-group-outline mb-3">
                <ckeditor
                  :editor="editor"
                  v-model="category.category_desc"
                ></ckeditor>
              </div>
              <span style="color: red" v-if="errors && errors.category_desc">
                {{ errors.category_desc[0] }}
              </span>
              <div class="form-check mb-3">
                <label for="show"> Show </label>
                <input
                  class="form-check-input"
                  type="radio"
                  id="show"
                  value="1"
                  v-model="category.category_status"
                />
                <label class="form-check-label" for="hide"> Hide </label>
                <input
                  class="form-check-input"
                  type="radio"
                  id="hide"
                  value="0"
                  v-model="category.category_status"
                />
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- End Modal -->
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  data() {
    return {
      editor: ClassicEditor,
      categories: [],
      category: {
        category_id: "",
        category_name: "",
        category_desc: "",
        category_status: "",
      },
      category_id: "",
      pagination: {},
      edit: false,
      errors: {},
      focusAll: false,
    };
  },
  created() {
    this.fetchCategories();
  },
  methods: {
    fetchCategories: function (page_url) {
      let vm = this;
      page_url = page_url || "api/categories";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.categories = res.data.category_list.data;
          vm.makePagination(res.data.category_list, res.data.category_list);
        })
        .catch((err) => console.log(err));
    },
    makePagination: function (meta, links) {
      console.log(links);
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        path: meta.path,
        next_page_url: links.next_page_url,
        prev_page_url: links.prev_page_url,
      };
      this.pagination = pagination;
    },
    deleteCategories: function (id) {
      Swal.fire({
        title: "Delete category #" + id + "?",
        showClass: {
          popup: "animate__animated animate__fadeInDown",
        },
        hideClass: {
          popup: "animate__animated animate__fadeOutUp",
        },
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("api/categories/" + id)
            .then((res) => {
              Swal.fire(
                "Deleted!",
                "Category #" + id + " has been deleted.",
                "success"
              );
              this.fetchCategories(
                this.pagination.path + "?page=" + this.pagination.current_page
              ); // fetch keep pages
            })
            .catch((err) => console.log(err));
        }
      });
    },
    saveCategory: function () {
      if (this.edit === false) {
        //add category
        let formData = new FormData();
        formData.append("category_name", this.category.category_name);
        formData.append("category_desc", this.category.category_desc);
        formData.append("category_status", this.category.category_status);

        axios
          .post("api/categories", formData)
          .then((response) => {
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "success",
              title: "Add successfully",
            });
            // alert
            this.errors = "";
            $("#staticBackdrop").modal("hide");
            this.fetchCategories();
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "error",
              title: "Oops! Something went wrong",
            });
            // alert
          });
      } else {
        //edit category
        axios
          .put(`api/categories/${this.category.category_id}`, {
            category_name: this.category.category_name,
            category_desc: this.category.category_desc,
            category_status: this.category.category_status,
          })
          .then((res) => {
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "success",
              title: "Update successfully",
            });
            // alert
            this.errors = "";
            $("#staticBackdrop").modal("hide");
            this.fetchCategories(
              this.pagination.path + "?page=" + this.pagination.current_page
            ); // fetch keep pages
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "error",
              title: "Oops! Something went wrong",
            });
            // alert
          });
      }
    },
    activeCategory: function (category_id) {
      //active category
      axios
        .get(`api/categories/${category_id}/edit`)
        .then((res) => {
          // alert
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "success",
            title: "Active category " + category_id,
          });
          // alert
          this.fetchCategories(
            this.pagination.path + "?page=" + this.pagination.current_page
          ); // fetch keep pages
        })
        .catch((error) => {
          // alert
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "error",
            title: "Oops! Something went wrong",
          });
          // alert
        });
    },
    inactiveCategory: function (category_id) {
      //active category
      Swal.fire({
        title: "Inactive category #" + category_id + " also inactive their subcategory and product!!",
        showClass: {
          popup: "animate__animated animate__fadeInDown",
        },
        hideClass: {
          popup: "animate__animated animate__fadeOutUp",
        },
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, inactive it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get(`api/categories/${category_id}/edit`)
            .then((res) => {
              // alert
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
              });

              Toast.fire({
                icon: "success",
                title: "Inactive category " + category_id,
              });
              // alert
              this.fetchCategories(
                this.pagination.path + "?page=" + this.pagination.current_page
              ); // fetch keep pages
            })
            .catch((error) => {
              // alert
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
              });

              Toast.fire({
                icon: "error",
                title: "Oops! Something went wrong",
              });
              // alert
            });
        }
      });
    },
    editCategory: function (category) {
      if(this.edit === false){
        this.edit = true;
      }
      if(this.focusAll === false){
        this.focusAll = true;
      }
      this.category.category_id = category.category_id;
      this.category.category_name = category.category_name;
      this.category.category_desc = category.category_desc;
      this.category.category_status = category.category_status;
      this.errors = "";
    },
    openAdd: function () {
      if(this.edit === true){
        this.edit = false;
      }
      if(this.focusAll === true){
        this.focusAll = false;
      }
      this.category.category_id = "";
      this.category.category_name = "";
      this.category.category_desc = "";
      this.category.category_status = "1";
      this.errors = "";
    },
  },
};
</script>