import React from "react";
import { TableContainer, Table, Tr, Td, Tbody } from '@chakra-ui/react';
import { Link } from "react-router-dom";
import { formatNumber } from "../../utils/utils";

const PlayerDetails = ({ infos }) => {
    const { ally_code, niveau, pg_totale, pg_heros, pg_vaisseaux, lien_profil } = infos;
    return <TableContainer>
        <Table variant='striped' colorScheme='gray'>
          <Tbody>
            <Tr>
              <Td>Niveau</Td>
              <Td isNumeric>{ niveau }</Td>
            </Tr>
            <Tr>
              <Td>Code allié</Td>
              <Td isNumeric>{ ally_code }</Td>
            </Tr>
            <Tr>
              <Td>Puissance galactique totale</Td>
              <Td isNumeric>{ formatNumber(pg_totale) }</Td>
            </Tr>
            <Tr>
              <Td>Puissance galactique des héros</Td>
              <Td isNumeric>{ formatNumber(pg_heros) }</Td>
            </Tr>
            <Tr>
              <Td>Puissance galactique des vaisseaux</Td>
              <Td isNumeric>{ formatNumber(pg_vaisseaux) }</Td>
            </Tr>
            <Tr>
              <Td>Lien</Td>
              <Td isNumeric color={'blue'}><Link to={ `${lien_profil}`}>{lien_profil}</Link></Td>
            </Tr>
          </Tbody>
        </Table>
      </TableContainer>
  }

export default PlayerDetails;