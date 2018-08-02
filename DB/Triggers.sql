-- Eliminar el stock y aumentar el numero de veces que se pidio un producto
DELIMITER //
CREATE TRIGGER tr_DetalleOrden AFTER INSERT ON detalleorden
	FOR EACH ROW BEGIN
		UPDATE productos SET Stock = Stock - NEW.Cantidad, Numero = Numero + NEW.Cantidad
		WHERE productos.idProductos = NEW.idProductos;
END
//
DELIMITER ;

-- Aumentar el numero de uso de una mesa
DELIMITER //
CREATE TRIGGER tr_upNumeroMesa AFTER INSERT ON orden
	FOR EACH ROW BEGIN
		UPDATE mesas SET Numero = Numero + 1
		WHERE mesas.idMesas = NEW.idMesas;
END
//
DELIMITER ;

-- Poner estado de la orden en 0 (0 es igual a orden saldada)
DELIMITER //
CREATE TRIGGER tr_upOrden AFTER INSERT ON venta
	FOR EACH ROW BEGIN
		UPDATE orden SET Estado = 0
		WHERE orden.idOrden = NEW.idOrden;
END
//
DELIMITER ;