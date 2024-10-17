import { APIRoutes } from '@/constants';
import { Color } from '@/models/Color';
import { FuelType } from '@/models/FuelType';
import { Model } from '@/models/Model';
import axios from 'axios';

export const useCommonService = () => {
  const handleCreateBrand = async (name: string) => {
    const { data } = await axios.post<Model>(route(APIRoutes.BRAND_CREATE), {
      name,
    });

    return data;
  };

  const handleCreateColor = async (color: string) => {
    const { data } = await axios.post<Color>(route(APIRoutes.COLOR_CREATE), {
      color,
    });

    return data;
  };

  const handleCreateFuelType = async (name: string) => {
    const { data } = await axios.post<FuelType>(
      route(APIRoutes.FUEL_TYPE_CREATE),
      {
        name,
      },
    );

    return data;
  };

  return {
    createBrand: handleCreateBrand,
    createColor: handleCreateColor,
    createFuelType: handleCreateFuelType,
  };
};
