/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

/**
 * wrist = 0
 * elbow back = 1
 * elbow front = 2
 */

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;

import java.util.HashMap;
import java.util.Map;

/**
 * Add your docs here.
 */
public class Arm extends Subsystem {

  private PIDMotorJoint m_elbow, m_wrist;
  private double m_jointHeight;

  private Map<String, double[]> m_presets;

  public Arm(double jointHeight, Elbow elbow, Wrist wrist) {
    m_elbow = elbow;
    m_wrist = wrist;
    m_jointHeight = jointHeight;

    m_presets = new HashMap<String, double[]>();

    m_presets.put("HOLD", new double[] { 0, -20 });
    m_presets.put("INTAKE_CARGO", new double[] { 0, -30 });
    m_presets.put("INTAKE_HATCH_GROUND", new double[] { -20, -25});
    m_presets.put("INTAKE_HATCH_HUMAN", new double[] { 0, 62 });
    m_presets.put("SHOOT_HATCH", new double[] { 45, 20 });
    m_presets.put("SHOOT_CARGO_FRONT", new double[] { 0, 30 });
    m_presets.put("SHOOT_CARGO_BACK", new double[] { 90, 120 });
    m_presets.put("RELEASE_HATCH", new double[] { -5, 80 });
  }

  public void zero() {
    m_elbow.resetAngle();
    m_wrist.resetAngle();
  }

  public void goToPreset(String presetName) {
    //System.out.println(presetName);
    setAngle(m_presets.get(presetName));
  }

  public boolean reachedDestination(){
    /*
    if (m_elbow.reachedDestination() && m_wrist.reachedDestination()){
      System.out.println("reached destination");
    }
    */
    return m_elbow.reachedDestination() && m_wrist.reachedDestination();
  }

  public void setAngle(double[] targetAngles) {
    //System.out.println(getAngles()[0] + " " + getAngles()[1]);
    m_elbow.setAngle(targetAngles[0]);
    if (targetAngles[1] >= 0 || getAngles()[0] > -5){
      //System.out.println(this.getName() + " " + getAngles()[1]);
      m_wrist.setAngle(targetAngles[1]-getAngles()[0]);
    } else {
      m_wrist.hold();
    }
  }

  public double[] getAngles() {
    return new double[] { m_elbow.getAngle(), m_wrist.getAngle()+m_elbow.getAngle()};
  }

  public void hold() {
    m_elbow.hold();
    m_wrist.hold();
  }

  public void enable() {
    m_elbow.enable();
    m_wrist.enable();
  }

  public void disable() {
    m_elbow.disable();
    m_wrist.disable();
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }
}
