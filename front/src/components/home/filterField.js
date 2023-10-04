
import React from "react";
import { Input } from '@chakra-ui/react';

const FilterField = ({onChangeFilter}) => {
    return <Input placeholder='Nom joueur' onChange={onChangeFilter} width={200} />
  }

export default FilterField;