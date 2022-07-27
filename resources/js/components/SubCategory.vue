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
              <h6 class="text-white text-capitalize ps-3">SubCategory table</h6>
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
              SubCategory
            </a>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <!-- <div class="container mt-3">
                            <div class="d-flex justify-content-between">
                                <div class="input-group input-group-outline m-3">
                                    <label class="form-label">
                                            Search your subcategory name
                                    </label>
                                    <input type="text" id="myFilter" onkeyup="myFilter()" class="form-control">
                                </div>
                                <form class="input-group input-group-outline m-3">
                                    @csrf
                                    <select name="category_filter" id="category_filter" class="form-control">
                                        <option value="{{Request::url()}}?filter_with=none">Filter SUBCATEGORY STATUS by</option>
                                        <option value="{{Request::url()}}?filter_with=1" {{Request::fullurl() == Request::url().'?filter_with=1' ? "selected" : ""}}>Show</option>
                                        <option value="{{Request::url()}}?filter_with=0" {{Request::fullurl() == Request::url().'?filter_with=0' ? "selected" : ""}}>Hide</option>
                                    </select>
                                </form>
                            </div>
                        </div> -->
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
                      SubCategory Name
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
                <tbody v-if="subcategories != ''">
                  <tr
                    v-for="(subcategory, index) in subcategories"
                    v-bind:key="index"
                  >
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="justify-content-center">
                          {{ subcategory.subcategory_id }}
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">
                        {{ subcategory.subcategory_name }}
                      </p>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">
                        {{ subcategory.category_name }}
                      </p>
                    </td>

                    <td
                      class="align-middle text-center"
                      v-if="subcategory.subcategory_status == 1"
                    >
                      <a
                        type="button"
                        @click="inactiveSubCategory(subcategory.subcategory_id)"
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
                        @click="activeSubCategory(subcategory.subcategory_id)"
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
                        @click="editSubCategory(subcategory)"
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
                        @click="deleteSubCategories(subcategory.subcategory_id)"
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
                  <td colspan="6">
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
                @click="fetchSubCategories(pagination.prev_page_url)"
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
                @click="fetchSubCategories(pagination.next_page_url)"
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
        <form @submit.prevent="saveSubCategory">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                Sub Category: #{{ subcategory.subcategory_id }}
              </h5>
              <a type="button">
                <i class="material-icons text-xl" data-bs-dismiss="modal"
                  >close</i
                >
              </a>
            </div>
            <div class="modal-body">
              <div class="input-group input-group-outline my-3">
                <label class="form-label"> SubCategory Name </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="subcategory.subcategory_name"
                />
              </div>
              <span style="color: red" v-if="errors && errors.subcategory_name">
                {{ errors.subcategory_name[0] }}
              </span>
              <br />
              <label class="form-label"> SubCategory Description </label>
              <div class="input-group input-group-outline mb-3">
                <ckeditor
                  :editor="editor"
                  v-model="subcategory.subcategory_desc"
                ></ckeditor>
              </div>
              <span style="color: red" v-if="errors && errors.subcategory_desc">
                {{ errors.subcategory_desc[0] }}
              </span>
              <div class="input-group input-group-outline mb-3">
                <select class="form-control" v-model="subcategory.category_id">
                  <option disabled value="">Please select one</option>
                  <option></option>
                </select>
              </div>
              <div class="form-check mb-3">
                <label for="show"> Show </label>
                <input
                  class="form-check-input"
                  type="radio"
                  id="show"
                  value="1"
                  v-model="subcategory.subcategory_status"
                />
                <label class="form-check-label" for="hide"> Hide </label>
                <input
                  class="form-check-input"
                  type="radio"
                  id="hide"
                  value="0"
                  v-model="subcategory.subcategory_status"
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
// import Category_list from "./Category.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  data() {
    return {
      editor: ClassicEditor,
      subcategories: [],
      categories: [],
      subcategory: {
        subcategory_id: "",
        subcategory_name: "",
        subcategory_desc: "",
        subcategory_status: "",
        category_id: "",
      },
      subcategory_id: "",
      pagination: {},
      edit: false,
      errors: {},
      focusAll: false,
      getPageFetchAllCategories: 1,
    };
  },
  created() {
    this.fetchSubCategories();
    this.fetchAllCategories();
  },
  methods: {
    fetchAllCategories: function () {
      let i = 1;
      while (this.getPageFetchAllCategories >= i) {
        fetch("api/categories?page=" + i)
          .then((res) => res.json())
          .then((res) => {
            this.categories = res.data;
            console.log(res);
            this.getPageFetchAllCategories = res.meta.last_page;
            i++;
          })
          .catch((err) => console.log(err));
      }
    },
    fetchSubCategories: function (page_url) {
      let vm = this;
      page_url = page_url || "api/subcategories";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.subcategories = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch((err) => console.log(err));
    },
    makePagination: function (meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        path: meta.path,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };
      this.pagination = pagination;
    },
  },
};
</script>