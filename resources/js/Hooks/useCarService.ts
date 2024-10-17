import { CarBrandModel } from '@/models/BrandModels';
import { Transmission } from '@/models/Transmission';
import { CarOptional } from '@/models/VehicleOptional';
import axios from 'axios';

export const useCarService = () => {
  const handleCreateModel = async (name: string, brandId: number) => {
    const { data } = await axios.post<CarBrandModel>(
      route('api.cars.model.create'),
      {
        name,
        brand: brandId,
      },
    );

    return data;
  };

  const handleCreateTransmissionType = async (name: string) => {
    const { data } = await axios.post<Transmission>(
      route('api.cars.transmission.create'),
      {
        name,
      },
    );

    return data;
  };

  const handleCreateOptional = async (name: string) => {
    const { data } = await axios.post<CarOptional>(
      route('api.cars.optionals.create'),
      {
        name,
      },
    );

    return data;
  };

  return {
    createModel: handleCreateModel,
    createTransmission: handleCreateTransmissionType,
    createOptional: handleCreateOptional,
  };
};
