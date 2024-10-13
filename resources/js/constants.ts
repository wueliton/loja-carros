export enum AdminRoutes {
  DASHBOARD = 'dashboard',

  CAR_LIST = 'admin.cars.list.view',

  USERS_LIST_VIEW = 'admin.users.list.view',
  USERS_CREATE_VIEW = 'admin.users.create.view',
  USERS_EDIT_VIEW = 'admin.users.edit.view',
  USERS_CREATE = 'admin.users.create',
  USERS_UPDATE = 'admin.users.update',
  USERS_DELETE = 'admin.users.delete',

  EDIT_STORE_VIEW = 'admin.store.edit.view',

  BRANDS_LIST = 'admin.brands.list.view',
  BRANDS_CREATE = 'admin.brands.create',
  BRANDS_EDIT = 'admin.brands.update',
  BRANDS_DELETE = 'admin.brands.delete',

  FUEL_TYPES_LIST = 'admin.fuelTypes.list.view',
  FUEL_TYPES_CREATE = 'admin.fuelTypes.create',
  FUEL_TYPES_EDIT = 'admin.fuelTypes.update',
  FUEL_TYPES_DELETE = 'admin.fuelTypes.delete',

  COLORS_LIST = 'admin.colors.list.view',
  COLORS_CREATE = 'admin.colors.create',
  COLORS_EDIT = 'admin.colors.update',
  COLORS_DELETE = 'admin.colors.delete',

  CAR_MODELS_LIST = 'admin.cars.models.list.view',
  CAR_MODELS_CREATE = 'admin.cars.models.create',
  CAR_MODELS_EDIT = 'admin.cars.models.update',
  CAR_MODELS_DELETE = 'admin.cars.models.delete',

  CAR_TRANSMISSIONS_LIST = 'admin.cars.transmissions.list.view',
  CAR_TRANSMISSIONS_CREATE = 'admin.cars.transmissions.create',
  CAR_TRANSMISSIONS_EDIT = 'admin.cars.transmissions.update',
  CAR_TRANSMISSIONS_DELETE = 'admin.cars.transmissions.delete',

  CAR_OPTIONALS_LIST = 'admin.cars.optionals.list.view',
  CAR_OPTIONALS_CREATE = 'admin.cars.optionals.create',
  CAR_OPTIONALS_EDIT = 'admin.cars.optionals.update',
  CAR_OPTIONALS_DELETE = 'admin.cars.optionals.delete',

  MOTO_MODELS_LIST = 'admin.motorcycles.models.list.view',
  MOTO_MODELS_CREATE = 'admin.motorcycles.models.create',
  MOTO_MODELS_EDIT = 'admin.motorcycles.models.update',
  MOTO_MODELS_DELETE = 'admin.motorcycles.models.delete',

  MOTO_TYPES_LIST = 'admin.motorcycles.types.list.view',
  MOTO_TYPES_CREATE = 'admin.motorcycles.types.create',
  MOTO_TYPES_EDIT = 'admin.motorcycles.types.edit',
  MOTO_TYPES_DELETE = 'admin.motorcycles.types.delete',

  MOTO_OPTIONALS_LIST = 'admin.motorcycles.optionals.list.view',
  MOTO_OPTIONALS_CREATE = 'admin.motorcycles.optionals.create',
  MOTO_OPTIONALS_EDIT = 'admin.motorcycles.optionals.edit',
  MOTO_OPTIONALS_DELETE = 'admin.motorcycles.optionals.delete',
}

export enum APIRoutes {
  BRAND_LIST = 'api.brand.list',
  BRAND_CREATE = 'api.brand.create',

  COLOR_LIST = 'api.colors.list',
  COLOR_CREATE = 'api.colors.create',

  FUEL_TYPE_LIST = 'api.fuelType.list',
  FUEL_TYPE_CREATE = 'api.fuelType.create',

  CAR_MODEL_LIST = 'api.cars.model.list',
  CAR_MODEL_CREATE = 'api.cars.model.create',

  CAR_TRANSMISSION_LIST = 'api.cars.transmission.list',
  CAR_TRANSMISSION_CREATE = 'api.cars.transmission.create',

  CAR_OPTIONALS_LIST = 'api.cars.optionals.list',
  CAR_OPTIONALS_CREATE = 'api.cars.optionals.create',

  CAR_IMAGE_DELETE = 'api.cars.images.delete',
  MOTO_MODEL_LIST = 'api.motorcycle.model.list',

  MOTO_MODEL_CREATE = 'api.motorcycle.model.create',
  MOTO_TYPES_LIST = 'api.motorcycle.types.list',

  MOTO_TYPES_CREATE = 'api.motorcycle.types.create',
  MOTO_OPTIONALS_LIST = 'api.motorcycle.optionals.list',

  MOTO_OPTIONALS_CREATE = 'api.motorcycle.optionals.create',
  MOTO_IMAGE_DELETE = 'api.motorcycle.images.delete',

  ADMIN_USERS_LIST = 'api.admin.users.list',

  SUPER_STORE_LIST = 'api.super.stores.list',
}

export enum UserRoutes {
  DASHBOARD = 'dashboard',

  CAR_LIST = 'cars.list.view',
  CAR_CREATE_VIEW = 'cars.create.view',
  CAR_EDIT_VIEW = 'cars.edit.view',
  CAR_CREATE = 'cars.create',
  CAR_EDIT = 'cars.edit',
  CAR_DELETE = 'cars.delete',

  MOTO_LIST = 'motorcycles.list.view',
  MOTO_CREATE_VIEW = 'motorcycles.create.view',
  MOTO_EDIT_VIEW = 'motorcycles.edit.view',
  MOTO_CREATE = 'motorcycles.create',
  MOTO_EDIT = 'motorcycles.edit',
  MOTO_DELETE = 'motorcycles.delete',

  STORE_VIEW = 'store.edit.view',
  STORE_SUGGEST_CHANGE = 'store.suggest-change',

  CHANGE_STORE = 'store.change-store',
}

export enum SuperRoutes {
  DASHBOARD = 'dashboard',

  STORE_LIST_VIEW = 'super.stores.list.view',
  STORE_CREATE_VIEW = 'super.stores.create.view',
  STORE_EDIT_VIEW = 'super.stores.edit.view',
  STORE_CREATE = 'super.stores.create',
  STORE_EDIT = 'super.stores.edit',
  STORE_DELETE = 'super.stores.delete',

  USERS_LIST_VIEW = 'super.users.list.view',
  USERS_CREATE_VIEw = 'super.users.create.view',
  USERS_EDIT_VIEW = 'super.users.edit.view',
  USERS_EDIT = 'super.users.edit',
  USERS_CREATE = 'super.users.create',
  USERS_DELETE = 'super.users.delete',

  CAR_LIST_VIEW = 'super.cars.list.view',
  CAR_CREATE_VIEW = 'super.cars.create.view',
  CAR_EDIT_VIEW = 'super.cars.edit.view',
  CAR_CREATE = 'super.cars.create',
  CAR_EDIT = 'super.cars.edit',
  CAR_DELETE = 'super.cars.delete',

  MOTORCYCLE_LIST_VIEW = 'super.motorcycles.list.view',
  MOTORCYCLE_CREATE_VIEW = 'super.motorcycles.create.view',
  MOTORCYCLE_EDIT_VIEW = 'super.motorcycles.edit.view',
  MOTORCYCLE_CREATE = 'super.motorcycles.create',
  MOTORCYCLE_EDIT = 'super.motorcycles.edit',
  MOTORCYCLE_DELETE = 'super.motorcycles.delete',
}

export const userRoles = {
  super: 'Administrador',
  admin: 'Logista',
  user: 'Vendedor',
};
