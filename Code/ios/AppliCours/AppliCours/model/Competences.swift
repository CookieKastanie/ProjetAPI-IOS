//
//  Competences.swift
//  AppliCours
//
//  Created by andre jeremy on 30/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import Foundation

struct Competences: Codable {
    var mailProf: String
    var idMat: String
    var idNiveau: String
    var matiere: String
    var niveau: String
    
    enum CodingKeys: String, CodingKey {
        case mailProf
        case idMat
        case idNiveau
        case matiere
        case niveau
    }
    
    init(from decoder: Decoder) throws {
        let valueContainer = try decoder.container(keyedBy: CodingKeys.self)
        
        self.mailProf = try valueContainer.decode(String.self, forKey: CodingKeys.mailProf)
        self.idMat = try valueContainer.decode(String.self, forKey: CodingKeys.idMat)
        self.idNiveau = try valueContainer.decode(String.self, forKey: CodingKeys.idNiveau)
        self.matiere = try valueContainer.decode(String.self, forKey: CodingKeys.matiere)
        self.niveau = try valueContainer.decode(String.self, forKey: CodingKeys.niveau)
    }
}
