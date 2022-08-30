<template>
  <div>
    <div class="card text-center">
      <div class="card-header">Shipping address</div>
      <div v-if="this.addresses.length > 0">
        <div v-for="(address, index) in addresses" v-bind:key="index">
          <div v-if="address.address_id == selected_address">
            <div class="card-body">
              <h5 class="card-title">
                {{ address.specific_address }}
              </h5>
              <p class="card-text">
                {{ address.ward_address.name_xaphuong }},
                {{ address.province_address.name_quanhuyen }},
                {{ address.city_address.name_city }}
              </p>
              <span class="badge rounded-pill bg-success">Default</span>
            </div>
            <div class="card-footer">
              <button
                @click="openAdd()"
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
                <h5 class="card-title">
                  {{ address.specific_address }}
                </h5>
                <p class="card-text">
                  {{ address.ward_address.name_xaphuong }},
                  {{ address.province_address.name_quanhuyen }},
                  {{ address.city_address.name_city }}
                </p>
                <span class="badge rounded-pill bg-success">Default</span>
              </div>
              <div class="card-footer">
                <button
                  @click="openAdd()"
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
          <a href="" class="btn btn-outline-success">Add address now</a>
        </div>
      </div>
    </div>
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
                  :id="'address'+(index+1)"
                  type="radio"
                  class="form-check-input"
                  v-bind:value="address.address_id"
                  :checked="checked_address == address.address_id"
                  v-model="checked_address"
                />
              </div>
              <div class="col-md-10">
                <label :for="'address'+(index+1)">
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
              @click="saveAddress()"
              class="btn btn-primary"
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
    };
  },
  created() {
    this.fetchAddresses();
  },
  methods: {
    fetchAddresses: function (page_url) {
      page_url = page_url || "api/address";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.addresses = res.data;
        })
        .catch((err) => console.log(err));
    },
    openAdd: function () {
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
    saveAddress: function () {
      this.selected_address = this.checked_address;
      $("#address_list").modal("hide");
      this.fetchAddresses();
    },
  },
};
</script>