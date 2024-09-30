import { Color } from '@/models/Color';
import { FuelType } from '@/models/FuelType';
import { Model } from '@/models/Model';
import axios from 'axios';

export const useCommonService = () => {
  const handleCreateBrand = async (name: string) => {
    const { data } = await axios.post<Model>(route('api.brand.create'), {
      name,
    });

    return data;
  };

  const handleCreateColor = async (color: string) => {
    const { data } = await axios.post<Color>(route('api.color.create'), {
      color,
    });

    return data;
  };

  const handleCreateFuelType = async (name: string) => {
    const { data } = await axios.post<FuelType>(route('api.fuelType.create'), {
      name,
    });

    return data;
  };

  return {
    createBrand: handleCreateBrand,
    createColor: handleCreateColor,
    createFuelType: handleCreateFuelType,
  };
};
