import { CarBrandModel } from '@/models/BrandModels';
import { Transmission } from '@/models/Transmission';
import { CarOptional } from '@/models/VehicleOptional';
import axios from 'axios';

export const useMotorcycleService = () => {
  const handleCreateModel = async (name: string, brandId: number) => {
    const { data } = await axios.post<CarBrandModel>(
      route('api.motorcycle.model.create'),
      {
        name,
        brand: brandId,
      },
    );

    return data;
  };

  const handleCreateType = async (name: string) => {
    const { data } = await axios.post<Transmission>(
      route('api.motorcycle.types.create'),
      {
        name,
      },
    );

    return data;
  };

  const handleCreateOptional = async (name: string) => {
    const { data } = await axios.post<CarOptional>(
      route('api.motorcycle.optionals.create'),
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
