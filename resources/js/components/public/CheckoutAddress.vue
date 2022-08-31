<template>
  <div>
    <div class="card text-center">
      <div class="card-header">Shipping address</div>
      <div v-if="this.addresses.length > 0">
        <div v-for="(address, index) in addresses" v-bind:key="index">
          <div v-if="address.address_id == selected_address">
            <div class="card-body">
              <h5 class="card-title" id="specific_address">
                {{ address.specific_address }}
              </h5>
              <input
                type="hidden"
                name="ward_address"
                v-bind:value="address.ward_address.xaid"
              />
              <input
                type="hidden"
                name="province_address"
                v-bind:value="address.province_address.maqh"
              />
              <input
                type="hidden"
                name="city_address"
                v-bind:value="address.city_address.matp"
              />
              <p class="card-text">
                {{ address.ward_address.name_xaphuong }},
                {{ address.province_address.name_quanhuyen }},
                {{ address.city_address.name_city }}
              </p>
              <span class="badge rounded-pill bg-success">Default</span>
            </div>
            <div class="card-footer">
              <button
                @click="openChange()"
                type="button"
                class="btn btn-outline-success"
                data-bs-toggle="modal"
                data-bs-target="#address_list"
              >
                Change your address
              </button>
            </div>
          </div>
          <div v-if="selected_address == 0">
            <div v-if="address.is_default == 1">
              <div class="card-body">
                <h5 class="card-title" id="specific_address">
                  {{ address.specific_address }}
                </h5>
                <input
                  type="hidden"
                  name="ward_address"
                  v-bind:value="address.ward_address.xaid"
                />
                <input
                  type="hidden"
                  name="province_address"
                  v-bind:value="address.province_address.maqh"
                />
                <input
                  type="hidden"
                  name="city_address"
                  v-bind:value="address.city_address.matp"
                />
                <p class="card-text">
                  {{ address.ward_address.name_xaphuong }},
                  {{ address.province_address.name_quanhuyen }},
                  {{ address.city_address.name_city }}
                </p>
                <span class="badge rounded-pill bg-success">Default</span>
              </div>
              <div class="card-footer">
                <button
                  @click="openChange()"
                  type="button"
                  class="btn btn-outline-success"
                  data-bs-toggle="modal"
                  data-bs-target="#address_list"
                >
                  Change your address
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="card-body">
          <p class="card-text">You have not add any address to your account</p>
        </div>
        <div class="card-footer">
          <button
            @click="openAdd()"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"
            class="btn btn-outline-success"
          >
            Add address now
          </button>
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
      <div class="modal-dialog">
        <form @submit.prevent="saveAddress">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                Address: #{{ address.address_id }}
              </h5>
              <a type="button">
                <i class="fa-solid fa-x" data-bs-dismiss="modal"></i>
              </a>
            </div>
            <div class="modal-body">
              <div class="input-group input-group-outline mb-3">
                <select
                  class="form-control"
                  @change="onChangeCity($event)"
                  v-model="address.city"
                  :class="{ ' is-invalid': errors.city }"
                >
                  <option disabled value="">Select your city</option>
                  <option
                    v-for="city in cities"
                    v-bind:value="city.matp"
                    :key="city.matp"
                  >
                    {{ city.name_city }}
                  </option>
                </select>
              </div>
              <div class="input-group input-group-outline mb-3">
                <select
                  class="form-control"
                  @change="onChangeProvince($event)"
                  v-model="address.province"
                  :class="{ ' is-invalid': errors.province }"
                >
                  <option disabled value="">Select your province</option>
                  <option
                    v-for="province in provinces"
                    v-bind:value="province.maqh"
                    v-bind:key="province.maqh"
                  >
                    {{ province.name_quanhuyen }}
                  </option>
                </select>
              </div>
              <div class="input-group input-group-outline mb-3">
                <select
                  class="form-control"
                  v-model="address.ward"
                  :class="{ ' is-invalid': errors.ward }"
                >
                  <option disabled value="">Select your ward</option>
                  <option
                    v-for="ward in wards"
                    v-bind:value="ward.xaid"
                    v-bind:key="ward.xaid"
                  >
                    {{ ward.name_xaphuong }}
                  </option>
                </select>
              </div>
              <div class="input-group input-group-outline my-3">
                <textarea
                  placeholder="Specific address"
                  type="text"
                  class="form-control"
                  :class="{ ' is-invalid': errors.specific_address }"
                  v-model="address.specific_address"
                ></textarea>
              </div>
              <br />
              <span>Address type:</span>
              <div class="form-check mb-3">
                <input
                  type="radio"
                  class="btn-check"
                  id="success-outlined"
                  value="1"
                  v-model="address.address_type"
                />
                <label class="btn btn-outline-success" for="success-outlined"
                  >Home</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  id="danger-outlined"
                  value="2"
                  v-model="address.address_type"
                />
                <label class="btn btn-outline-success" for="danger-outlined"
                  >Office</label
                >
              </div>
              <span style="color: red" v-if="errors && errors.address_type">
                {{ errors.address_type[0] }}
              </span>
              <div class="form-check form-switch">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="flexSwitchCheckChecked"
                  v-model="address.is_default"
                  :disabled="disabled"
                />
                <label class="form-check-label" for="flexSwitchCheckChecked"
                  >Set as default address</label
                >
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- End Modal -->

    <!--Modal list address-->

    <!-- Modal -->
    <div
      class="modal fade"
      id="address_list"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="address_list">Your address list</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div
            class="modal-body"
            v-for="(address, index) in addresses"
            v-bind:key="index"
          >
            <div class="row">
              <div class="col-md-2">
                <input
                  :id="'address' + (index + 1)"
                  type="radio"
                  class="form-check-input"
                  v-bind:value="address.address_id"
                  :checked="checked_address == address.address_id"
                  v-model="checked_address"
                />
              </div>
              <div class="col-md-10">
                <label :for="'address' + (index + 1)">
                  <h6>
                    <strong>
                      {{ address.specific_address }}
                    </strong>
                  </h6>
                  <span>
                    {{ address.ward_address.name_xaphuong }},
                    {{ address.province_address.name_quanhuyen }},
                    {{ address.city_address.name_city }}
                  </span>
                  <br />
                  <span
                    v-if="address.is_default == 1"
                    class="badge rounded-pill bg-success"
                    >Default</span
                  >

                  <span
                    v-if="address.address_type == 1"
                    class="badge rounded-pill bg-warning text-dark"
                    >Home</span
                  >

                  <span v-else class="badge rounded-pill bg-warning text-dark"
                    >Office</span
                  >
                </label>
              </div>
            </div>
          </div>
          <hr />
          <div class="justify-content-start mx-2">
            <button
              @click="openAdd()"
              data-bs-toggle="modal"
              data-bs-target="#staticBackdrop"
              class="btn btn-outline-primary"
            >
              Add more address
            </button>
          </div>
          <hr />
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              @click="saveSelectedAddress()"
              class="btn btn-primary save_change_address"
            >
              Save
            </button>
          </div>
        </div>
      </div>
    </div>
    <!--Modal list address-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      cities: [],
      provinces: [],
      wards: [],
      addresses: [],
      address: {
        address_id: "",
        specific_address: "",
        address_type: "",
        is_default: false,
        city: "",
        province: "",
        ward: "",
      },
      edit: false,
      errors: {},
      selected_address: 0,
      checked_address: 0,
      disabled: false,
    };
  },
  created() {
    this.fetchAddresses();
  },
  methods: {
    fetchCity: function (page_url) {
      page_url = page_url || "api/city";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.cities = res.data;
        })
        .catch((err) => console.log(err));
    },
    fetchProvince: function (page_url) {
      page_url = `api/province/${page_url}`;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.provinces = res.data;
        })
        .catch((err) => console.log(err));
    },
    fetchWard: function (page_url) {
      page_url = `api/ward/${page_url}`;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.wards = res.data;
        })
        .catch((err) => console.log(err));
    },
    fetchAddresses: function (page_url) {
      page_url = page_url || "api/address";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.addresses = res.data;
        })
        .catch((err) => console.log(err));
    },
    onChangeCity(event) {
      this.address.province = null;
      axios
        .get(`api/province/${event.target.value}`)
        .then((res) => {
          this.provinces = res.data.data;
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
    onChangeProvince(event) {
      this.address.ward = null;
      axios
        .get(`api/ward/${event.target.value}`)
        .then((res) => {
          this.wards = res.data.data;
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
    openChange: function () {
      if (this.selected_address == 0) {
        this.addresses.forEach((value, index) => {
          if (value.is_default == 1) {
            this.checked_address = value.address_id;
          }
        });
      } else {
        this.checked_address = this.selected_address;
      }
    },
    openAdd: function () {
      $("#address_list").modal("hide");
      this.fetchCity();
      if (this.edit === true) {
        this.edit = false;
      }
      if (this.addresses.length == 0) {
        this.disabled = true;
        this.address.is_default = true;
      } else {
        this.address.is_default = false;
      }
      this.address.address_id = "";
      this.address.address_type = "1";
      this.address.city = "";
      this.address.province = "";
      this.address.ward = "";
      this.address.specific_address = "";
      this.errors = "";
    },
    saveSelectedAddress: function () {
      axios
        .get(`api/address/${this.checked_address}/edit`)
        .then((res) => {
          this.fetchAddresses();
        })
        .catch((error) => {
          console.log(error);
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
      this.selected_address = this.checked_address;
      $("#address_list").modal("hide");
      this.fetchAddresses();
    },
    saveAddress: function () {
      if (this.edit === false) {
        //add address
        if (this.addresses.length < 5) {
          let formData = new FormData();
          formData.append("city", this.address.city);
          formData.append("province", this.address.province);
          formData.append("ward", this.address.ward);
          formData.append("specific_address", this.address.specific_address);
          formData.append("address_type", this.address.address_type);
          formData.append("is_default", this.address.is_default);

          axios
            .post("api/address", formData)
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
              this.fetchAddresses();
              if(this.disabled){
                window.location.reload();
              }
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
            title:
              "Oops! You have reach maximum of 5 address, delete or edit ones",
          });
          // alert
        }
      }
    },
  },
};
</script>