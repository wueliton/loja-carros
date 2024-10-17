import { APIRoutes } from '@/constants';
import { CarBrandModel } from '@/models/BrandModels';
import { Transmission } from '@/models/Transmission';
import { CarOptional } from '@/models/VehicleOptional';
import axios from 'axios';

export const useMotorcycleService = () => {
  const handleCreateModel = async (name: string, brandId: number) => {
    const { data } = await axios.post<CarBrandModel>(
      route(APIRoutes.MOTO_MODEL_CREATE),
      {
        name,
        brand: brandId,
      },
    );

    return data;
  };

  const handleCreateType = async (name: string) => {
    const { data } = await axios.post<Transmission>(
      route(APIRoutes.MOTO_TYPES_CREATE),
      {
        name,
      },
    );

    return data;
  };

  const handleCreateOptional = async (name: string) => {
    const { data } = await axios.post<CarOptional>(
      route(APIRoutes.MOTO_OPTIONALS_CREATE),
      {
        name,
      },
    );

    return data;
  };

  return {
    createModel: handleCreateModel,
    createType: handleCreateType,
    createOptional: handleCreateOptional,
  };
};
